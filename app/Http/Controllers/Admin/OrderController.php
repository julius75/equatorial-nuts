<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderRegion;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirementSubmission;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

    public function map(Request $request)
    {
        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        //$data['orders'] = Order::query()->with('order_region')->get();
        $data['latitude'] = 0.17687; //default set to kenya's gps coordinates
        $data['longitude'] = 37.90833;
        //when page loads
        if ($request->all() == []){
            $orderData = OrderRegion::query()
                ->with(['order', 'region'])->get();
            $data['current_region'] = "all";
            $data['current_raw_material'] = "all";
            $data['current_buyer'] = "all";
        }
        //region specified rest are "all"
        elseif ($request->region_id and $request->region_id != "all" and $request->buyer_id == "all" and $request->raw_material_id == "all"){
            $orderData = OrderRegion::query()
                ->where('region_id', '=', $request->region_id)
                ->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = $request->buyer_id;
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id and $request->raw_material_id != "all" and $request->buyer_id == "all" and $request->region_id == "all"){
            $orderData = OrderRegion::query()
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = $request->buyer_id;
        }
        //buyer specified
        elseif ($request->buyer_id and $request->buyer_id != "all" and $request->raw_material_id == "all" and $request->region_id == "all"){
            $orderData = OrderRegion::query()
                ->whereHas('order', function ($q) use ($request){
                    $q->where('user_id', '=', $request->buyer_id);
                })->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = $request->buyer_id;
        }
        //region and raw material specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all" and $request->buyer_id == "all"){
            $orderData = OrderRegion::query()
                ->where('region_id', '=', $request->region_id)
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = "all";
        }
        //region and buyer specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id == "all"){
            $orderData = OrderRegion::query()
                ->whereHas('order', function ($q) use ($request){
                    $q->where('user_id', '=', $request->buyer_id);
                })
                ->where('region_id', '=', $request->region_id)
                ->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = "all";
            $data['current_buyer'] = $request->buyer_id;

        }
        //raw material and buyer specified
        elseif ($request->region_id == "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $orderData = OrderRegion::query()
                ->whereHas('order', function ($q) use ($request){
                    $q->where('user_id', '=', $request->buyer_id);
                })
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order', 'region'])->get();
            $data['current_region'] = "all";
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = $request->buyer_id;
        }
        //everything specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $orderData = OrderRegion::query()
                ->where('region_id', '=', $request->region_id)
                ->whereHas('order', function ($q) use ($request){
                    $q->where('user_id', '=', $request->buyer_id);
                })
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order', 'region'])->get();
            $data['current_region'] = $request->region_id;
            $data['current_raw_material'] = $request->raw_material_id;
            $data['current_buyer'] = $request->buyer_id;
        }
        else{
            $orderData = OrderRegion::query()
                ->with(['order', 'region'])->get();
            $data['current_region'] = "all";
            $data['current_raw_material'] = "all";
            $data['current_buyer'] = "all";
        }
        $data['mapOrders'] = $orderData;
        return view('admin.orders.map', $data);
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
        elseif ($request->region_id == "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //everything specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($query) use ($request){
                        $query->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($query) use ($request){
                        $query->where('region_id', '=', $request->region_id);
                    });
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
                return '<a href="'.route('admin.orders.show', $data->ref_number).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View
                        </a>
						';
            })
            ->make(true);
    }

    public function show($ref_number){
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->with([
                'order_region.region',
                'order_region.buying_center',
                'order_region.region.county',
                'order_region.region.sub_county',
                'order_raw_material.raw_material',
                'order_raw_material.bag_type',
                'user',
                'farmer',
                'price_list',
                'mpesa_disbursement_transaction'
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");
//        dd($order);
        $data['order'] = $order;
        $data['page_title'] = $order->ref_number;
        $data['page_description'] = "Order Details";
        return view('admin.orders.show', $data);
    }

    public function get_order_raw_material_requirement_submissions($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        $data = $order->raw_material_requirement_submissions()
            ->whereHas('active_raw_material_requirement')
            ->with('active_raw_material_requirement')
            ->get();
        return Datatables::of($data)->make(true);
    }

    public function get_order_mpesa_transaction($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        $data = $order->mpesa_disbursement_transaction()
            ->get();
        return Datatables::of($data)->make(true);
    }
}
