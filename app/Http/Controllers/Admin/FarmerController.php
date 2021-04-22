<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\FarmerVerificationCode;
use App\Models\RawMaterial;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FarmerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.farmers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $regions = Region::all();
        $materials = RawMaterial::all();

        return view('admin.farmers.create',compact('regions','materials'));
    }
    public function getAdminFarmers()
    {
        $users = Farmer::with(['region:id,name','raw_materials:id,name'])
        ->where('status', '=', true)
        ->orderByDesc('created_at')->get();
        return Datatables::of($users)
            ->addColumn('region', function ($users){
                return $users->region->name;
            })
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-farmers.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-farmers.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    		<button type="button" name="edit" id="'.$users->id.'" class="delete btn btn-danger btn-sm">Delete</button>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(),
            [
                'full_name'=>'required',
                'phone_number' => 'required|unique:farmers',
                'id_number' => 'required|unique:farmers',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'region_id' => 'required|exists:regions,id',
                'raw_material_ids.*' => 'required|exists:raw_materials,id',
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try{
            $farmer = Farmer::create([
                'full_name'=>$request->full_name,
                'phone_number'=>$request->phone_number,
                'id_number'=>$request->id_number,
                'gender'=>strtoupper($request->gender),
                'region_id'=>$request->region_id,
                'date_of_birth'=>$request->date_of_birth,
            ]);

            $farmer->raw_materials()->sync($request->raw_material_ids, true);

            $code = $farmer->verification_codes()->create([
                'passcode'=>$this->generate_OTP(),
                'issued'=>true,
                'expires_at'=>Carbon::now()->addMinutes(10),
            ]);

            //send otp
//            SendSMS::dispatch($farmer->phone_number, "Your Equatorial Nut Farmer Verification Token is: $code->passcode");
//            $farmer_details = [
//                'id'=>$farmer->id,
//                'full_name'=>$farmer->full_name,
//                'id_number'=>$farmer->id_number,
//                'phone_number'=>$farmer->phone_number
//            ];
            return Redirect::route('admin.app-farmers.index')->with('message','Farmer created Successfully');
        }catch (\Exception $e){
            return Redirect::route('admin.app-farmers.create')->with('error', 'Something went wrong');
        }
    }
    /**
     * @return integer
     */
    protected function generate_OTP()
    {
        $otp = mt_rand(1000, 9999);
        while ($this->check_OTP_exists($otp)) {
            $otp = mt_rand(1000, 9999);
        }
        return $otp;
    }
    /**
     * @param int $otp
     * @return mixed
     */
    protected function check_OTP_exists(int $otp)
    {
        return FarmerVerificationCode::query()->where('passcode','=',$otp)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = Farmer::findOrFail($id);
            $materials = $user->raw_materials()->first()->name ?? '--';;
            return view('admin.farmers.show',compact('user','materials'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    public function test()
    {
            $user = Farmer::findOrFail(1);
        $usr =  $user->raw_materials()->first()->name  ?? '--';;
            return $usr;

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = Farmer::findOrFail($id);
            $regions = Region::all();
            $materials = RawMaterial::all();
            return view('admin.farmers.edit',compact('user','materials','regions'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    public function statusUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Farmer Not Found');
        }

        try {
            $user = Farmer::findOrFail($id);
            $user->status = $request->status;
            $user->save();
            return redirect()->route('admin.app-farmers.index')->with('message', 'Farmer Status Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('error', 'Error Try Again...');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            return $id;
            $user = Farmer::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('message', 'Farmer Record Deleted successfully');

        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteFarmer($id)
    {
        Farmer::find($id)->delete();

        return response()->json(['success'=>'Farmer deleted successfully.']);


    }

}
