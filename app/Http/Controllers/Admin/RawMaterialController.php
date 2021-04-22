<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirement;
use Illuminate\Http\Request;
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
            ->make(true);
    }
}
