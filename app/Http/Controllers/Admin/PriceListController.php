<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PriceList;
use App\Models\RawMaterial;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\Facades\DataTables;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        $raw_materials = RawMaterial::all();
        return view('admin.pricelists.index',compact('regions','raw_materials'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function current()
    {
        return view('admin.pricelists.current');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        $raw_materials = RawMaterial::all();
        return view('admin.pricelists.create', compact('raw_materials', 'regions'));
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
            'region_id' => 'required|exists:regions,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'amount' => 'required|min:0|max:1000000',
            'value' => 'required',
            'unit' => 'required',
        ]);
        if ($validator->fails()) {
           return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $priceList = PriceList::query()->create([
           'region_id'=>$request->region_id,
           'raw_material_id'=>$request->raw_material_id,
           'amount'=>$request->amount,
           'value'=>$request->value,
           'unit'=>$request->unit,
           'date'=>now(),
            'created_by'=>Auth::guard()->id()
        ]);
        if ($priceList)
            return Redirect::route('admin.price-lists.pending-approval')->with('success', 'Price Created Successfully');

        return Redirect::back()->withInput()->with('error', 'Something Went Wrong, refresh page and try again');
    }

    /**
     * Get All PriceLists
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_all_pricelists(Request $request)
    {

        if($request->region_id) {
            $users = PriceList::with(['region:id,name','raw_material:id,name','approvedBy:id,first_name,last_name','createdBy:id,first_name,last_name']);
            $userss = $users->whereHas('raw_material', function( $query ) use ( $request ){
                $query->where('raw_material_id', $request->raw_material_id);
            })->WhereHas('region', function( $query ) use ( $request ){
                $query->where('region_id', $request->region_id);
            });
            $data = $userss->get();
            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }
        if ($request->region_id == null){
            $data = PriceList::query()
                ->with(['region:id,name','raw_material:id,name','approvedBy:id,first_name,last_name','createdBy:id,first_name,last_name'])
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }

        }

    /**
     * Get Current PriceLists
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_current_pricelists()
    {
        $data = PriceList::query()
            ->where('current', '=', true)
            ->with(['region:id,name','raw_material:id,name','approvedBy:id,first_name,last_name','createdBy:id,first_name,last_name'])
            ->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }

    /**
     * Display a listing of the pendind approvals.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_approval()
    {
        return view('admin.pricelists.pending_approval');
    }

    /**
     * Get Pending Approval PriceLists
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_pending_approval()
    {
        $data = PriceList::query()
            ->where('approved', '=', false)
            ->with(['region:id,name','raw_material:id,name','approvedBy:id,first_name,last_name','createdBy:id,first_name,last_name'])
            ->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.price-lists.approve', encrypt($data->id)).'" class="btn btn-success">
                            <i class="flaticon2-pie-chart"></i> Approve Price
                        </a>
						';
            })
            ->make(true);
    }

    /**
     * Approve PriceList
     *
     * @param string $priceListID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(string $priceListID)
    {
        $pricelist = PriceList::query()
            ->findOrFail(decrypt($priceListID));
        if ($pricelist->approved == false){
            $prev = PriceList::query()
                ->where([
                    'region_id'=>$pricelist->region_id,
                    'raw_material_id'=>$pricelist->raw_material_id,
                    'current'=>true
                ])->first();

            if ($prev){
                $prev->update([
                    'current'=>false,
                ]);
            }
            $pricelist->update([
                'current'=>true,
                'approved'=>true,
                'approved_by'=>Auth::id()
            ]);
            return Redirect::back()->with('success', 'Price Approved Successfully');
        }
        else
            return Redirect::back()->with('warning', 'Price already approved');

    }


}
