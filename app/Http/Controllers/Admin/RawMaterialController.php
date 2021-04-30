<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the raw materials with specifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function requirements()
    {
        return view('admin.raw-materials.requirements');
    }
    public function edit_requirement($id)
    {
        $rawMaterial = RawMaterial::query()->findOrFail($id);

        return view('admin.raw-materials.edit-requirement',compact('rawMaterial'));
    }
    /**
     * Display a listing of the raw materials with specifications.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function view_requirements($id)
    {
        $data['raw_material'] = RawMaterial::query()
            ->withCount('raw_material_requirements')
            ->find($id);
        return view('admin.raw-materials.view-requirements', $data);
    }

    /**
     * Create New Requirement Page
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function create_new_requirement($id)
    {
        $rawMaterial = RawMaterial::query()->findOrFail($id);
        return view('admin.raw-materials.create-requirement', compact('rawMaterial'));
    }

    /**
     * Store a newly created Requirement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_new_requirement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'raw_material_id' => 'required|exists:raw_materials,id',
            'parameter' => 'required',
            'type' => 'required|in:percentage,integer,text',
            'value' => 'required|in:MAX,MIN,null',
            'requirement' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $rawMaterial = RawMaterial::query()->find($request->get('raw_material_id'));
        try{
            $value = $request->get('value');
            if ($value == "null")
                $value = null;

            $rawMaterial->raw_material_requirements()->create([
                'parameter'=>$request->get('parameter'),
                'type'=>$request->get('type'),
                'value'=>$value,
                'requirement'=>$request->get('requirement'),
                'unit'=>$request->get('unit') ?? null,
                'status'=>true,
            ]);
            return Redirect::route('admin.raw-materials.view.requirement', $rawMaterial->id)
                ->with('success', $rawMaterial->name.' Requirement Created Successfully Created Successfully');

        }catch (\Exception $exception) {
            return Redirect::back()->withInput()->with('error', 'Something Went Wrong, refresh page and try again');
        }
    }
    /**
     * Get Raw Materials with Requirement counts
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function get_requirements()
    {
        $data = RawMaterial::query()
            ->withCount('raw_material_requirements')
            ->withCount('buying_centers')
            ->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.raw-materials.view.requirement', $data->id).'" class="btn btn-success">
                            <i class="flaticon2-pie-chart"></i> View
                        </a>
						';
            })
            ->make(true);
    }

    /**
     * Get Pending Approval PriceLists
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_requirements_single($id)
    {
        $data = RawMaterialRequirement::query()
            ->where('raw_material_id', '=', $id)
            ->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="#" class="btn btn-sm btn-secondary">
                            <i class="flaticon2-pie-chart"></i> Edit
                        </a>
						';
            })
            ->addColumn('action', function ($data) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link"  href="'.route('admin.edit-requirement', $data->id).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
		<li class="nav-item"><a class="nav-link"  href="'.route('admin.edit-requirement', $data->id).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>

							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }
}
