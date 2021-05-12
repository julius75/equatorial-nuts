<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BagType;
use App\Models\Order;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirementSubmission;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    /**
     * View the Inventory Management Dashboard
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function index()
    {
        $data['reviewedOrders'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereHas('order_raw_material_inventory_review', function ($q){
                $q->where('admin_id', '=', Auth::id());
            })
            ->count();
        $data['ordersPendingReview'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereDoesntHave('order_raw_material_inventory_review')
            ->count();
        $data['allReviewedOrders'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereHas('order_raw_material_inventory_review', function ($q){
                $q->where('admin_id', '=', Auth::id());
            })
            ->count();

        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        return view('admin.inventory.index', $data);
    }

    /**
     * Load Data Table
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function get_orders(Request $request)
    {
        //region specified rest are "all"
        if ($request->region_id and $request->region_id != "all" and $request->buyer_id == "all" and $request->raw_material_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id and $request->raw_material_id != "all" and $request->buyer_id == "all" and $request->region_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //buyer specified
        elseif ($request->buyer_id and $request->buyer_id != "all" and $request->raw_material_id == "all" and $request->region_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all" and $request->buyer_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($q) use ($request){
                        $q->where('region_id', '=', $request->region_id);
                    });
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //region and buyer specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //raw material and buyer specified
        elseif ($request->region_id == "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        //everything specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($query) use ($request){
                        $query->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($query) use ($request){
                        $query->where('region_id', '=', $request->region_id);
                    });
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        else{
            $data = Order::query()->where('disbursed', '=', true)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'order_raw_material_inventory_review'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if (!$data->order_raw_material_inventory_review()->exists()){

                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.order-inventory-management.view-review', $data->ref_number).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.order-inventory-management.make-review', $data->ref_number).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Make Review</span></a></li>
							    	</ul>
							  	</div>
							</div>';
                }else{
                    return '<a href="'.route('admin.order-inventory-management.view-review', $data->ref_number).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View Submitted Review
                        </a>
						';
                }

            })
            ->addColumn('reviewed', function ($data) {
                return $data->order_raw_material_inventory_review()->exists();
            })
            ->addColumn('reviewed_by', function ($data) {
                if ($data->order_raw_material_inventory_review()->exists()){
                    return Admin::query()->find($data->order_raw_material_inventory_review->first()->admin_id)->full_name;
                }else{
                    return '--';
                }
            })
            ->make(true);
    }

    /**
     * View Review
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function view_review($ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->with([
                'order_raw_material_inventory_review',
                'order_raw_material',
                'order_raw_material.bag_type',
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");
        $data['order'] = $order;
        $data['raw_material_requirement_submissions_data'] = $this->get_order_raw_material_requirement_inventory_graph($ref_number);
        return view('admin.inventory.view_review', $data);
    }

    /**
     * View the form for submitting a review
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function make_review($ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->with([
                'order_raw_material_inventory_review',
                'order_raw_material',
                'order_raw_material.bag_type',
                'order_raw_material.raw_material',
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");
        $data['order'] = $order;
        $data['raw_materials'] = RawMaterial::all();
        $data['bag_types'] = BagType::all();
        return view('admin.inventory.make_review', $data);
    }

    /**
     * Submit a Review
     * @param Request $request
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function post_review(Request $request, $ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");
        $validator = Validator::make($request->all(), [
            'raw_material_id'=>'required|exists:raw_materials,id',
            'bag_type_id'=>'required|exists:bag_types,id',
            'bags'=>'required|integer',
            'gross_weight'=>'required|numeric',
            'net_weight'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        if ($order->order_raw_material_inventory_review()->exists()){
            return Redirect::back()->with('warning', "$order->ref_number has already been reviewed");
        }
        $admin_id = Auth::guard('admin')->id();
        $order->order_raw_material_inventory_review()->create([
            'raw_material_id'=>$request->get('raw_material_id'),
            'bags'=>$request->get('bags'),
            'gross_weight'=>$request->get('gross_weight'),
            'net_weight'=>$request->get('net_weight'),
            'bag_type_id'=>$request->get('bag_type_id'),
            'admin_id'=>$admin_id,
        ]);
        return Redirect::route('admin.order-inventory-management.index')->with('success', "Review for order $order->ref_number has been submitted successfully.");
    }

    /**
     * Load Inventory DataTable Table
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function get_order_raw_material_inventory_submissions($ref_number){
        $order = Order::query()->where('ref_number', '=', $ref_number)
            ->with([
                'order_raw_material.bag_type',
                'order_raw_material_inventory_review',
                'order_raw_material_inventory_review.bag_type',
                ])
            ->first();

        $reviewed_bag_type = $reviewed_net_weight = $reviewed_gross_weight = $reviewed_bags = '<span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning ">Pending Review</span>';

        if ($order->order_raw_material_inventory_review()->first()){
            $reviewed_bags = $order->order_raw_material_inventory_review->bags;
            $reviewed_gross_weight = $order->order_raw_material_inventory_review->gross_weight;
            $reviewed_net_weight = $order->order_raw_material_inventory_review->net_weight;
            $reviewed_bag_type = $order->order_raw_material_inventory_review->bag_type->name;
        }
        $data = collect([
            [
                'name'=>'Number Of Bags',
                'parameters'=>['submitted'=>$order->order_raw_material->bags, 'reviewed'=>$reviewed_bags]
            ],
            [
                'name'=>'Gross Weight',
                'parameters'=>['submitted'=>$order->order_raw_material->gross_weight, 'reviewed'=>$reviewed_gross_weight]
            ],
            [
                'name'=>'Net Weight',
                'parameters'=>['submitted'=>$order->order_raw_material->net_weight, 'reviewed'=>$reviewed_net_weight],
            ],
            [
                'name'=>'Bag Type',
                'parameters'=>['submitted'=>$order->order_raw_material->bag_type->name, 'reviewed'=>$reviewed_bag_type]
            ]
        ]);
        return Datatables::of($data)
            ->addColumn('reviewed_by', function ($data)use($order){
                if($order->order_raw_material_inventory_review()->first()) {
                    return Admin::query()->find($order->order_raw_material_inventory_review()->first()->admin_id)->full_name;
                }else{
                    return   '--';
                }
            })
            ->addColumn('reviewed_at', function ($data)use($order){
                if($order->order_raw_material_inventory_review()->first()) {
                    return $order->order_raw_material_inventory_review()->first()->created_at;
                }else{
                    return   '--';
                }
            })
            ->addColumn('created_at', function ($data)use($order){
                return $order->created_at;
            })
            ->rawColumns(['parameters.reviewed'])
            ->make(true);
    }

    /**
     * Load Inventory Graph
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function get_order_raw_material_requirement_inventory_graph($ref_number) {
        $order = Order::query()->where('ref_number', '=', $ref_number)
            ->with(['order_raw_material', 'order_raw_material_inventory_review'])
            ->firstOrFail();

        $labels = ['Gross Weight kgs.', 'Net Weight kgs.', 'Number of Bags'];
        $submissions = [$order->order_raw_material->gross_weight, $order->order_raw_material->net_weight, $order->order_raw_material->bags];
        if ($order->order_raw_material_inventory_review){
            $evaluations = [$order->order_raw_material_inventory_review->gross_weight, $order->order_raw_material_inventory_review->net_weight, $order->order_raw_material_inventory_review->bags];
        } else {
            $evaluations = [];
        }

        $max_figures_array = [];
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
            'submitted_values' => $submissions,
            'evaluation_values' => $evaluations,
            'max_value' => $max_figure,
        ));
    }

}
