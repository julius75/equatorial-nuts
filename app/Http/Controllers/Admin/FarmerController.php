<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\Admin;
use App\Models\BuyingCenter;
use App\Models\Farmer;
use App\Models\FarmerVerificationCode;
use App\Models\Order;
use App\Models\OrderRegion;
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
     * @param  string  $encrypted_id
     */
    public function show(string $encrypted_id)
    {
        try {
            $farmer = Farmer::query()
                ->with('region')
                ->findOrFail(Crypt::decrypt($encrypted_id));
            $data['farmer'] = $farmer;
            $data['materials'] = RawMaterial::all();
            $data['buying_centers'] = BuyingCenter::query()
                ->where('region_id', '=', $farmer->region_id)
                ->get();
            $complete_orders_amount = Order::query()
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->sum('amount');
            $complete_orders_count = Order::query()
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->count();
            $data['transactionsAmount'] = $complete_orders_amount;
            $data['transactionsCount'] = $complete_orders_count;
            $data['latitude'] = 0.17687; //default set to kenya's gps coordinates
            $data['longitude'] = 37.90833;

            $orderIDs = Order::query()
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->get()
                ->pluck('id')
                ->toArray();

            if (count($orderIDs) == 0) {
                $orderData = [];
            } else {
                $orderData = OrderRegion::query()
                    ->whereIn('region_id', [18, 21])
                    ->with(['order', 'region', 'buying_center'])
                    ->get();
            }
            dd(count($orderIDs), $orderIDs, $orderData);
            $data['mapOrders'] = $orderData;
            return view('admin.farmers.show', $data);
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

    /**
     * Get Farmer Orders
     *
     * @param Request $request
     * @param string $encryptedId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function get_orders(Request $request, string $encryptedId)
    {
        $farmer = Farmer::query()->find(Crypt::decrypt($encryptedId));
        //buying_center specified rest are "all"
        if ($request->buying_center_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('buying_center_id', '=', $request->buying_center_id);
                })
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id != "all" and $request->buying_center_id == "all"){
            $data = Order::query()
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->buying_center_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->where(function($query) use($request){
                    $query->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $query->whereHas('order_region', function ($q) use ($request){
                        $q->where('buying_center_id', '=', $request->buying_center_id);
                    });
                })
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        else{
            $data = Order::query()
                ->where(['disbursed' => true, 'farmer_id'=> $farmer->id])
                ->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.orders.show', $data->ref_number).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View
                        </a>
						';
            })
            ->make(true);
    }

    /**
     * Get Farmer Raw Materials
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function get_raw_materials(int $id)
    {
        $farmer = Farmer::query()->with('raw_materials')->find($id);
        $data = $farmer->raw_materials;
        return Datatables::of($data)
            ->make(true);
    }

    /**
     * Get Farmer Raw Materials
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach_raw_material(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'farmer_id' => 'required|exists:farmers,id',
                'raw_material_ids' =>  'required',
                'raw_material_ids.*' => 'required|exists:raw_materials,id',
            ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('raw_material_ids.*')) {
                return  Redirect::back()->withErrors($validator)->withInput()->with('error', "One of the Selected Raw Materials is invalid");
            }
            else {
                return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
            }
        }
        try{
            $farmer = Farmer::query()->find($request->farmer_id);
            $farmer->raw_materials()->sync($request->raw_material_ids, true);
            return Redirect::back()->with('message',"$farmer->full_name's raw materials have been synced successfully");
        }catch (\Exception $e){
            return Redirect::back()->with('error', 'Something went wrong');
        }
    }
}
