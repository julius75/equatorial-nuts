<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BuyerCreated;
use App\Models\BuyingCenter;
use App\Models\County;
use App\Models\Farmer;
use App\Models\RawMaterial;
use App\Models\Region;
use App\Models\SubCounty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
    public function regions()
    {
        $users = User::role('buyer')->get();
        $details = [
            'page'=>1,
            'pages'=>1,
            'perpage'=>-1,
            'total'=>50,
            'sort'=>"asc",
            'field'=>"RecordID",

        ];
        $data=[];
        foreach ($users as $user){
            $numbers_with_icons = [];
            $datas = [
                'RecordID'=>$user->id,
                'FirstName'=>$user->first_name,
                'LastName'=>$user->first_name,
                'Email'=>$user->email,
                'Phone'=>$user->phone_number,
                'Status'=>5,
                'Type'=>5,

            ];
            array_push($numbers_with_icons, $datas);
            $data=  $numbers_with_icons;

        }
        return ['meta' => $details, 'data' => $data];
    }

    public function getAdminRegions()
    {
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
            ->editColumn('created_at', function ($users){
                return Carbon::parse($users->created_at)->isoFormat('MMM D YYYY');
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
							    		<button type="button" name="edit" id="'.$users->id.'" class="delete btn btn-danger btn-sm">Delete</button>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
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
        $departmentData = County::orderby("name","asc")->select('id','name')->get();
        $sub_county = SubCounty::all();
        return view('admin.regions.create',compact('regions','materials','sub_county','departmentData'));
    }
    // Fetch records
    public function getSubCounty($id=0){

        // Fetch Employees by Departmentid
        $empData['data'] = SubCounty::query()
            ->orderby("name","asc")
            ->select('id','name')
            ->where('county_id',$id)
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
    public function updateRegionsDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|min:4|max:20',
            'region' => 'required',
            'material_id' => 'required',
            'region_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {
            $center = BuyingCenter::query()->create([
                'region_id' => $request->region_id,
                'name' => $request->name,
            ]);
            DB::table('buying_center_raw_materials')
                ->updateOrInsert(
                    ['buying_center_id' => $center->id],
                    ['raw_material_id' => $request->material_id,]
                );
            return Redirect::route('admin.app-regions.index')->with('message','Raw Material attached Successfully To The Centre');

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-regions.index')->with('error', 'Something went wrong');
        }
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
            $region = Region::findOrFail($id);
            $materials = RawMaterial::all();
            return view('admin.regions.show',compact('region','materials'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    public function getRegions($id)
    {
        try {
            $region = Region::findOrFail($id);
            $buying_centers = $region->buying_centers()->get() ?? '--';
          //  return $buying_centers;
            return Datatables::of($buying_centers)
                ->editColumn('created_at', function ($buying_centers){
                    return Carbon::parse($buying_centers->created_at)->isoFormat('MMM D YYYY');
                })
                ->make(true);
        } catch (ModelNotFoundException $e) {
            return $e;
        }

    }

    public function test(){
        $centers = BuyingCenter::join('buying_center_raw_materials', 'buying_center_raw_materials.buying_center_id', '=', 'buying_centers.id')
            ->join('raw_materials', 'raw_materials.id', '=', 'buying_center_raw_materials.raw_material_id')
            ->where('buying_centers.region_id',1)
            ->get(['buying_centers.*', 'buying_center_raw_materials.raw_material_id as raw_material_id','raw_materials.name as raw_material_name']);
        //$materials = BuyingCenter::where('region_id', 1)->get();
        return $users;
        $centers = BuyingCenter::where('region_id', 1)->pluck('id')->toArray();
        $buying_center = DB::table('buying_center_raw_materials')
            ->whereIn('raw_material_id', $centers)
            ->pluck('id')->toArray();
        $centers = BuyingCenter::where('region_id', 1)->pluck('id')->toArray();
        $buying_center = DB::table('buying_center_raw_materials')
            ->whereIn('raw_material_id', $centers)
            ->pluck('id')->toArray();




    }
    public function getMaterials($id)
        {
         try {
             $centers = BuyingCenter::join('buying_center_raw_materials', 'buying_center_raw_materials.buying_center_id', '=', 'buying_centers.id')
                 ->join('raw_materials', 'raw_materials.id', '=', 'buying_center_raw_materials.raw_material_id')
                 ->where('buying_centers.region_id',$id)
                 ->get(['buying_centers.*', 'buying_center_raw_materials.raw_material_id as raw_material_id','raw_materials.name as raw_material_name']);

             return Datatables::of($centers,)
            ->editColumn('buying', function ($raw_materials){
                return $raw_materials->name;
            })
                 ->editColumn('materials', function ($materials){
                     return $materials->raw_material_name;
                 })
            ->make(true);
    } catch (ModelNotFoundException $e) {
        return $e;
    }

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
