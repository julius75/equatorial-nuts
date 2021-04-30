<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyingCenter;
use App\Models\RawMaterial;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuyingCentreController extends Controller
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
        $materials = RawMaterial::all();
        return view('admin.buying-centre.index',compact('materials'));
    }
    public function getCentres()
    {
        try {
            $centres = BuyingCenter::all();
            return Datatables::of($centres)
                ->editColumn('region', function ($centres){
                    return $centres->region->name;
                })
                ->editColumn('created_at', function ($centres){
                    return Carbon::parse($centres->created_at)->isoFormat('MMM D YYYY');
                })
                ->addColumn('action', function ($centres) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-buying-centre.show',Crypt::encrypt($centres->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Region Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-buying-centre.edit',Crypt::encrypt($centres->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5 materials" id="'.$centres->id.'"><i class="nav-icon la flaticon-attachment"></i><span class="nav-text">Raw Materials</span></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        } catch (ModelNotFoundException $e) {
            return $e;
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

        return view('admin.buying-centre.create', compact('regions'));
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
            'region_id' => 'required',
            'name' =>  'required|min:4|max:20',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {
            $user = BuyingCenter::query()->create([
                'region_id' => $request->region_id,
                'name' => $request->name,
            ]);

            return Redirect::route('admin.app-buying-centre.index')->with('message','Buying Centre created Successfully');

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-buying-centre.create')->with('error', 'Something went wrong');
        }
    }
    public function AttachCentre(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::table('buying_center_raw_materials')
                ->updateOrInsert(
                    ['buying_center_id' => $id],
                    ['raw_material_id' => $request->name,]
                );
            return Redirect::route('admin.app-buying-centre.index')->with('message','Raw Material attached Successfully');

        }
        catch (\Exception $exception) {
            return Redirect::route('admin.app-buying-centre.index')->with('error', 'Something went wrong');
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
            $center = BuyingCenter::findOrFail($id);
            $regions = Region::findOrFail($id);

            $buying_center = DB::table('buying_center_raw_materials')
                ->where('buying_center_id', '=', $id)
                ->get();
            $materials = RawMaterial::where('id', '=', 1)->first();
            return view('admin.buying-centre.show',compact('regions','materials','center'));
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
        try {
            $id = Crypt::decrypt($id);
            $regions = Region::all();
            $center = Region::findOrFail($id);
            $materials = RawMaterial::all();
            return view('admin.buying-centre.edit',compact('center','materials','regions'));
        } catch (ModelNotFoundException $e) {
            return Redirect::back()->with('error', 'Farmer Not Found');

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
