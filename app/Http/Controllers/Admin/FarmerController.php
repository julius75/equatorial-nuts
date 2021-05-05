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
        $regions = Region::all();
        return view('admin.farmers.index',compact('regions'));
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

    public function getAdminFarmers(Request $request)
    {
        //region specified
        if($request->region_id != "all") {
            $data = Farmer::with(['region:id,name','raw_materials:id,name'])
                ->whereHas('region', function( $query ) use ( $request ){
                $query->where('region_id', $request->region_id);
            })
                ->orderByDesc('created_at')->get();
        }
        //default
        else {
            $data = Farmer::with(['region:id,name','raw_materials:id,name'])
               ->orderByDesc('created_at')->get();
        }
        return Datatables::of($data)
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
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-farmers.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Farmer Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-farmers.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
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
                'phone_number'=>'254'.substr($request->phone_number, -9),
                'id_number'=>$request->id_number,
                'gender'=>strtoupper($request->gender),
                'region_id'=>$request->region_id,
                'date_of_birth'=>$request->date_of_birth,
            ]);

            $farmer->raw_materials()->sync($request->raw_material_ids, true);

            $farmer->verification_codes()->create([
                'passcode'=>$this->generate_OTP(),
                'issued'=>true,
                'verified'=>true,
                'expires_at'=>Carbon::now()->addMinutes(10),
            ]);

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
     */
    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = Farmer::findOrFail($id);
            $materials = $user->raw_materials()->first()->name ?? '--';;
            return view('admin.farmers.show',compact('user','materials'));
        } catch (ModelNotFoundException $e) {
            return Redirect::back()->with('error', 'Farmer Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     *
     *
     */
    public function edit(string $id)
    {
        $farmer = Farmer::query()->with(['region'])->findOrFail(Crypt::decrypt($id));
        $regions = Region::all();
        return view('admin.farmers.edit',compact('farmer','regions'));
    }

    /**
     * Update Farmer Status
     *
     * @param Request $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'full_name'=>'required',
                'phone_number' => 'required',
                'id_number' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'region_id' => 'required|exists:regions,id'
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try{
            $farmer = Farmer::query()->find($id);
            $farmer->update([
                'full_name'=>$request->full_name,
                'phone_number'=>'254'.substr($request->phone_number, -9),
                'id_number'=>$request->id_number,
                'gender'=>strtoupper($request->gender),
                'region_id'=>$request->region_id,
                'date_of_birth'=>$request->date_of_birth,
            ]);
            return Redirect::route('admin.app-farmers.index')->with('message',"$farmer->full_name's details have been updated successfullly");
        }catch (\Exception $e){
            return Redirect::route('admin.app-farmers.index')->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        // do nothing
    }
}
