<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BuyerCreated;
use App\Models\BuyingCenter;
use App\Models\County;
use App\Models\Farmer;
use App\Models\Order;
use App\Models\OrderRegion;
use App\Models\RawMaterial;
use App\Models\Region;
use App\Models\SubCounty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
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
        return view('admin.regions.index');
    }

    public function getAdminRegions()
    {
        $user = Auth::user();
        if ($user->hasRole(['general_management','management'])) {
            $users = Region::with(['county:id,name', 'sub_county:id,name','buying_centers'])
                ->orderByDesc('created_at')->get();
            return Datatables::of($users)
                ->addColumn('county', function ($users){
                    return $users->county->name;
                })
                ->addColumn('sub_county', function ($users){
                    return $users->sub_county->name;
                })
                ->editColumn('buying_center_count', function ($users){
                    return $users->buying_centers->count() ?? '--';
                })
                ->addColumn('action', function ($users) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-regions.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Region Details</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }
        else{
            $users = Region::with(['county:id,name', 'sub_county:id,name','buying_centers'])
                ->orderByDesc('created_at')->get();
            return Datatables::of($users)
                ->addColumn('county', function ($users){
                    return $users->county->name;
                })
                ->addColumn('sub_county', function ($users){
                    return $users->sub_county->name;
                })
                ->editColumn('buying_center_count', function ($users){
                    return $users->buying_centers->count() ?? '--';
                })
                ->addColumn('action', function ($users) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-regions.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Region Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-regions.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }

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
        $departmentData = County::orderby("name", "asc")->select('id', 'name')->get();
        $sub_county = SubCounty::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.regions.create', compact('regions', 'materials', 'sub_county', 'departmentData'));
        }
        else{
            return abort(403);
        }
    }
    /**
     * Fetch SubCounties
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCounty($id=0) {

        $empData['data'] = SubCounty::query()
            ->orderby("name","asc")
            ->select('id','name')
            ->where('county_id','=', $id)
            ->get();
        return response()->json($empData);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|min:4|max:20',
            'county_id' => 'required',
            'sub_county_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {
            $user = Region::query()->create([
                'name' => $request->name,
                'county_id' => $request->county_id,
                'sub_county_id' => $request->sub_county_id
            ]);

            return Redirect::route('admin.app-regions.index')->with('message','Region created Successfully');

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-regions.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_new_region_buying_center(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|min:4|max:20|unique:buying_centers,name',
            'raw_material_ids' =>  'required',
            'raw_material_ids.*' => 'required|exists:raw_materials,id',
            'region_id' => 'required|exists:regions,id',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {

            $buying_center = BuyingCenter::query()->create([
                'region_id' => $request->region_id,
                'name' => $request->name,
            ]);
            $buying_center->raw_materials()->sync($request->raw_material_ids, true);

            return Redirect::back()->with('message','Raw Material attached Successfully To The Centre');

        } catch (\Exception $exception) {
            return Redirect::back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $encrypted_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $encrypted_id)
    {
        $data['region'] = Region::query()->withCount('buying_centers')->findOrFail(Crypt::decrypt($encrypted_id));
        $data['materials'] = RawMaterial::all();
        $data['buying_centers'] = BuyingCenter::query()->where('region_id', '=', $data['region']->id)->get();
        $complete_orders_amount = Order::query()->where(['disbursed' => true])
            ->whereHas('order_region', function ($q) use ($data){
                $q->where('region_id', '=', $data['region']->id);
            })
            ->sum('amount');
        $complete_orders_count = Order::query()->where(['disbursed' => true])
            ->whereHas('order_region', function ($q) use ($data){
                $q->where('region_id', '=', $data['region']->id);
            })
            ->count();
        $data['transactionsAmount'] = $complete_orders_amount;
        $data['transactionsCount'] = $complete_orders_count;
        $data['latitude'] = 0.17687; //default set to kenya's gps coordinates
        $data['longitude'] = 37.90833;
        $orderData = OrderRegion::query()
            ->where('region_id', '=', $data['region']->id)
            ->with(['order', 'region', 'buying_center'])->get();
        $data['mapOrders'] = $orderData;
        return view('admin.regions.show',$data);

    }

    /**
     * Get a Region's Buying Centers with respective raw materials offered
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_region_buying_centers($id)
        {
         $data = BuyingCenter::query()
             ->where('region_id', '=', $id)
             ->with('raw_materials')->get();
         return Datatables::of($data)
             ->addColumn('materials_offered', function ($data){
                 $materials_offered = [];
                 foreach ($data->raw_materials as $raw_material) {
                     array_push($materials_offered, $raw_material->name);
                 }
                 return  implode(", ", $materials_offered);
             })
             ->addColumn('action', function ($data) {
                 return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-buying-centre.edit', Crypt::encrypt($data->id)).'">
							    		<i class="nav-icon la la-user"></i><span class="nav-text">Edit Buying Center Details</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
             })
        ->make(true);

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['region'] = Region::query()->with(['county', 'sub_county'])->findOrFail(Crypt::decrypt($id));
        $data['departmentData'] = County::orderby("name","asc")->select('id','name')->get();
        $data['sub_county'] = SubCounty::all();
        return view('admin.regions.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|min:4|max:20',
            'county_id' => 'required|exists:counties,id',
            'sub_county_id' => 'required|exists:sub_counties,id',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {
            $region = Region::query()->findOrFail($id);
            $region->update([
                'name' => $request->name,
                'county_id' => $request->county_id,
                'sub_county_id' => $request->sub_county_id
            ]);

            return Redirect::route('admin.app-regions.index')->with('message',"$region->name updated Successfully");

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-regions.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get Regions Orders
     *
     * @param Request $request
     * @param string $encryptedId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function get_orders(Request $request, string $encryptedId)
    {
        $region = Region::query()->find(Crypt::decrypt($encryptedId));
        //buying_center specified rest are "all"
        if ($request->buying_center_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->whereHas('order_region', function ($q) use ($request, $region){
                    $q->where('region_id', '=', $region->id);
                    $q->where('buying_center_id', '=', $request->buying_center_id);
                })
                ->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id != "all" and $request->buying_center_id == "all"){
            $data = Order::query()
                ->whereHas('order_region', function ($q) use ($request, $region){
                    $q->where('region_id', '=', $region->id);
                })
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->buying_center_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->where(function($query) use($request, $region){
                    $query->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $query->whereHas('order_region', function ($q) use ($request, $region){
                        $q->where('region_id', '=', $region->id);
                        $q->where('buying_center_id', '=', $request->buying_center_id);
                    });
                })
                ->with(['order_region.buying_center', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        else{
            $data = Order::query()
                ->whereHas('order_region', function ($q) use ($request, $region){
                    $q->where('region_id', '=', $region->id);
                })
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
}
