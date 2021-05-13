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
use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
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
        $data['raw_materials'] = RawMaterial::all();
        $data['regions'] = Region::all();
        if (Auth::user()->role != 'general_management') {
            return view('admin.buying-centre.index', $data);
        }
        else{
            return abort(403);
        }
    }

    /**
     * Fetch all buying centers
     *
     * @return \Illuminate\Http\Response
     */
    public function getCentres(Request $request)
    {
        if ($request->region_id == "all" and $request->raw_material_id == "all") {
            $centres = BuyingCenter::query()
                    ->with('raw_materials')
                    ->get();
        }
        //region specified
        elseif ($request->region_id != "all"and $request->raw_material_id == "all") {
            $centres = BuyingCenter::query()
                ->where('region_id', '=', $request->region_id)
                ->withCount('raw_materials')
                ->with('raw_materials')
                ->get();;
        }
        //raw material specified
        elseif ($request->region_id == "all" and $request->raw_material_id != "all") {
            $centres = BuyingCenter::query()
                ->whereHas('raw_materials', function ($query) use ($request){
                    $query->where('raw_materials.id', '=', $request->raw_material_id);
                })
                ->with('raw_materials')
                ->get();;
        }
        //raw material and region specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all") {
            $centres = BuyingCenter::query()
                ->whereHas('raw_materials', function ($query) use ($request){
                    $query->where('raw_materials.id', '=', $request->raw_material_id);
                })
                ->where('region_id', '=', $request->region_id)
                ->with('raw_materials')
                ->get();;
        }
        else {
            $centres = BuyingCenter::query()
                ->with('raw_materials')
                ->get();
        }

        return Datatables::of($centres)
            ->editColumn('region', function ($centres){
                return $centres->region->name;
            })
            ->addColumn('materials_offered', function ($centres){
                $materials_offered = [];
                foreach ($centres->raw_materials as $raw_material) {
                    array_push($materials_offered, $raw_material->name);
                }
                return  implode(", ", $materials_offered);
            })
            ->addColumn('action', function ($centres) {
                return '<div class="dropdown dropdown-inline">
                            <a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                <i class="la la-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.route('admin.app-buying-centre.edit',Crypt::encrypt($centres->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
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
        $raw_materials = RawMaterial::all();
        if (Auth::user()->role != 'general_management') {
            return view('admin.buying-centre.create', compact('regions', 'raw_materials'));
        }
        else{
            return abort(403);
        }
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
        $buying_center = BuyingCenter::query()->create([
            'name' => $request->name,
            'region_id' => $request->region_id,
        ]);

        $buying_center->raw_materials()->sync($request->raw_material_ids, true);

        return Redirect::route('admin.app-buying-centre.index')->with('message','Buying Centre created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = BuyingCenter::query()->with(['region', 'raw_materials'])->findOrFail(Crypt::decrypt($id));
        $regions = Region::all();
        $raw_materials = RawMaterial::all();
        return view('admin.buying-centre.edit',compact('center', 'regions', 'raw_materials'));

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
        $validator = Validator::make($request->all(), [
            'region_id' => 'required',
            'name' =>  'required|min:4|max:20',
            'raw_material_ids' =>  'required',
            'raw_material_ids.*' => 'required|exists:raw_materials,id',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('raw_material_ids.*'))
                return  Redirect::back()->withErrors($validator)->withInput()->with('error', "One of the Selected Raw Materials is invalid");
            else
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $buying_center = BuyingCenter::query()->findOrFail($id);
        $buying_center->update([
            'name'=>$request->name,
            'region_id'=>$request->region_id,
        ]);
        $buying_center->raw_materials()->sync($request->raw_material_ids, true);

        return Redirect::back()->with('success', 'Buying center details updated successfully');

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
