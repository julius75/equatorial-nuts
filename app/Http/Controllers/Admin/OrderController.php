<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RawMaterial;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        return view('admin.orders.index', $data);
    }

    public function get_orders(Request $request)
    {
        //region specified rest are "all"
        if ($request->region_id and $request->region_id != "all" and $request->buyer_id == "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id and $request->raw_material_id != "all" and $request->buyer_id == "all" and $request->region_id == "all"){
            $data = Order::query()
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //buyer specified
        elseif ($request->buyer_id and $request->buyer_id != "all" and $request->raw_material_id == "all" and $request->region_id == "all"){
            $data = Order::query()
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all" and $request->buyer_id == "all"){
            $data = Order::query()
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($q) use ($request){
                        $q->where('region_id', '=', $request->region_id);
                    });
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and buyer specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                 ->whereHas('order_region', function ($q) use ($request){
                     $q->where('region_id', '=', $request->region_id);
                 })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material and buyer specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($q) use ($request){
                        $q->where('region_id', '=', $request->region_id);
                    });
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //everything specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        else{
            $data = Order::query()
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.price-lists.approve', encrypt($data->id)).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View
                        </a>
						';
            })
            ->make(true);
    }
}
