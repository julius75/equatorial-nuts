<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\MpesaDisbursementRequest;
use App\Models\MpesaDisbursementTransaction;
use App\Models\Order;
use App\Models\OrderRegion;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirementSubmission;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')
            ->only(['order_disbursement_reconciliation', 'get_order_disbursement_reconciliation', 'order_disbursement_reconciliation_form']);

    }
    public function index()
    {
        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        return view('admin.orders.index', $data);
    }

    public function order_disbursement_reconciliation()
    {
        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        return view('admin.orders.order_disbursement_reconciliation', $data);
    }

    public function order_disbursement_reconciliation_form($ref_number)
    {
        $order = Order::query()->where('ref_number', '=', $ref_number)->firstOrFail();
        if ($order->disbursed == true){
            return Redirect::back()->with('warning', "Order $ref_number has already been marked as Disbursed");
        }
        $data['order'] = $order;
        return view('admin.orders.reconcile_form', $data);
    }

    public function order_reconciliation_post(Request $request, $ref_number){
        $validator = Validator::make($request->all(), [
            'date_disbursed' => 'required|date',
            'transaction_receipt' => 'required|unique:mpesa_disbursement_transactions,transaction_receipt',
            'channel' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        if(!$order){
            return Redirect::back()->withInput()->with('error', "Order $ref_number Not Found!");
        }
        if ($order->disbursed == true){
            return Redirect::back()->withInput()->with('warning', "Order $ref_number was already marked as disbursed");
        }
        DB::beginTransaction();
        try {
            $transaction = new MpesaDisbursementTransaction();
            $transaction->order_id = $order->id;
            $transaction->transaction_receipt = $request->get('transaction_receipt');
            $transaction->amount = $order->amount;
            $transaction->channel = $request->get('channel');
            $transaction->disbursed_at = $request->get('date_disbursed');
            $transaction->save();

            $order->update([
                "disbursed" => true,
                "completed" => true,
                "disbursed_at"=> $request->get('date_disbursed')
            ]);

            $disbursement_request = MpesaDisbursementRequest::query()->where('order_id', '=', $order->id)->first();
            if ($disbursement_request){
                $disbursement_request->update(['issued'=>true]);
            }
            DB::commit();
            return Redirect::route('admin.orders.show', $order->ref_number)->with('success', "$order->ref_number has been reconciled successfully");
        }catch (\Exception $exception){
            return Redirect::back()->with('error', "$order->ref_number reconciliation failed, refresh page and try again");
        }
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

    public function get_order_disbursement_reconciliation(Request $request)
    {
        //region specified rest are "all"
        if ($request->region_id and $request->region_id != "all" and $request->buyer_id == "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id and $request->raw_material_id != "all" and $request->buyer_id == "all" and $request->region_id == "all"){
            $data = Order::query()
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //buyer specified
        elseif ($request->buyer_id and $request->buyer_id != "all" and $request->raw_material_id == "all" and $request->region_id == "all"){
            $data = Order::query()
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all" and $request->buyer_id == "all"){
            $data = Order::query()
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
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
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
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
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
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
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
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
                ->where(['disbursed'=> false, 'completed'=> false])
                ->whereHas('mpesa_disbursement_request', function ($q) use ($request){
                    $q->where('issued', '=', false);
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.orders.show', $data->ref_number).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Order Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.orders.order_disbursement_reconciliation_form', $data->ref_number).'"><i class="nav-icon la la-folder"></i><span class="nav-text">Reconcile Order</span></a></li>
							    	</ul>
							  	</div>
							</div>';
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
        $data['order'] = $order;
        $data['page_title'] = $order->ref_number;
        $data['page_description'] = "Order Details";
        $data['raw_material_requirement_submissions_data'] = $this->get_order_raw_material_requirement_submissions_graph($order->ref_number);
        $data['raw_material_inventory_submissions_data'] = (new InventoryController())->get_order_raw_material_requirement_inventory_graph($order->ref_number);
//        echo $data['raw_material_requirement_submissions_data'];die();
        return view('admin.orders.show', $data);
    }

    public function get_order_raw_material_requirement_submissions_graph($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        $data = $order->raw_material_requirement_submissions()
            ->whereHas('active_raw_material_requirement', function ($q){
                $q->where('type', '!=' , 'text');
            })
            ->with(['active_raw_material_requirement', 'raw_material_requirement_review'])
            ->get();
        $labels = [];
        $required = [];
        $submissions = [];
        $evaluations = [];
        foreach ($data as $req) {
            if ($req->active_raw_material_requirement->type != "text") {
                array_push($labels, $req->active_raw_material_requirement->parameter.'-'.$req->active_raw_material_requirement->value);
                array_push($required, $req->active_raw_material_requirement->requirement);
                array_push($submissions, $req->value);
                if ($req->raw_material_requirement_review) {
                    array_push($evaluations, $req->raw_material_requirement_review->value);
                }
            }
        }

        $max_figures_array = [];
        if (!empty($required)){
            $max_required = max( $required );
            $max_required = round(( $max_required + 10/2 ) / 10 ) * 10;
            array_push($max_figures_array, $max_required);
        }
        if (!empty($submissions)){
            $max_submission = max( $submissions );
            $max_submission = round(( $max_submission + 10/2 ) / 10 ) * 10;
            array_push($max_figures_array, $max_submission);
        }
        if (!empty($evaluations)){
            $max_evaluation = max( $evaluations );
            $max_evaluation = round(( $max_evaluation + 10/2 ) / 10 ) * 10;
            array_push($max_figures_array, $max_evaluation);
        }
        if (!empty($max_figures_array)){
            $max_figure = max( $max_figures_array );
            $max_figure = round(( $max_figure + 10/2 ) / 10 ) * 10;
        } else {
            $max_figure = 0;
        }

        return json_encode(array(
            'labels' => $labels,
            'required_values' => $required,
            'submitted_values' => $submissions,
            'evaluation_values' => $evaluations,
            'max_value' => $max_figure,
        ));
    }

    public function get_order_raw_material_requirement_submissions($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        $data = $order->raw_material_requirement_submissions()
            ->whereHas('active_raw_material_requirement')
            ->with('active_raw_material_requirement')
            ->with('raw_material_requirement_review')
            ->get();
        return Datatables::of($data)
            ->addColumn('review', function ($data){
                if(isset($data->raw_material_requirement_review->value)) {
                    return $data->raw_material_requirement_review->value;
                }else{
                    return   '<span class="label label-warning label-dot mr-2"></span>
                              <span class="font-weight-bold text-warning ">Pending Review</span>';
                }
            })
            ->addColumn('reviewed_by', function ($data){
                if(isset($data->raw_material_requirement_review->admin_id)) {
                    return Admin::query()->find($data->raw_material_requirement_review->admin_id)->full_name;
                }else{
                    return   '--';
                }
            })
            ->addColumn('reviewed_at', function ($data){
                if(isset($data->raw_material_requirement_review->created_at)) {
                    return $data->raw_material_requirement_review->created_at;
                }else{
                    return   '--';
                }
            })
            ->rawColumns(['review'])
            ->make(true);
    }

    public function get_order_mpesa_transaction($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)->first();
        $data = $order->mpesa_disbursement_transaction()
            ->get();
        return Datatables::of($data)->make(true);
    }
}
