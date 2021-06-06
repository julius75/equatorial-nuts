<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirementSubmission;
use App\Models\Region;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\isEmpty;

class QualityController extends Controller
{
    /**
     * View the Quality Management Dashboard
     * @return array|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function index()
    {
        $data['reviewedOrders'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereHas('raw_material_requirement_reviews', function ($q){
               $q->where('admin_id', '=', Auth::id());
            })
            ->count();
        $data['ordersPendingReview'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereDoesntHave('raw_material_requirement_reviews')
            ->count();
        $data['allReviewedOrders'] = Order::query()
            ->where('disbursed', '=', true)
            ->whereHas('raw_material_requirement_reviews', function ($q){
                $q->where('admin_id', '=', Auth::id());
            })
            ->count();

        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        $data['buyers'] = User::query()->where('status', '=', true)->get();
        return view('admin.quality.index', $data);
    }

    /**
     * Load Data Table
     * @param Request $request
     * @return array|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
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
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id and $request->raw_material_id != "all" and $request->buyer_id == "all" and $request->region_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        //buyer specified
        elseif ($request->buyer_id and $request->buyer_id != "all" and $request->raw_material_id == "all" and $request->region_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
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
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        //region and buyer specified
        elseif ($request->region_id != "all" and $request->buyer_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        //raw material and buyer specified
        elseif ($request->region_id == "all" and $request->buyer_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()->where('disbursed', '=', true)
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->where('user_id', '=', $request->buyer_id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
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
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        else{
            $data = Order::query()->where('disbursed', '=', true)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user', 'raw_material_requirement_reviews'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if (!$data->raw_material_requirement_reviews()->exists()){

                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.order-quality-management.view-review', $data->ref_number).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.order-quality-management.make-review', $data->ref_number).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Make Review</span></a></li>
							    	</ul>
							  	</div>
							</div>';
                }else{
                    return '<a href="'.route('admin.order-quality-management.view-review', $data->ref_number).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View Submitted Review
                        </a>
						';
                }

            })
            ->addColumn('reviewed', function ($data) {
                return $data->raw_material_requirement_reviews()->exists();
            })
            ->addColumn('reviewed_by', function ($data) {
                if ($data->raw_material_requirement_reviews()->exists()){
                    return Admin::query()->find($data->raw_material_requirement_reviews->first()->admin_id)->full_name;
                }else{
                    return '--';
                }
            })
            ->make(true);
    }

    /**
     * View Review
     * @param $ref_number
     * @return array|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function view_review($ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->with([
                'raw_material_requirement_submissions.raw_material_requirement',
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");
        $data['order'] = $order;
        $data['raw_material_requirement_submissions_data'] = (new OrderController)->get_order_raw_material_requirement_submissions_graph($order->ref_number);
        return view('admin.quality.view_review', $data);
    }

    /**
     * View the form for submitting a review
     * @param $ref_number
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function make_review($ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->whereDoesntHave('raw_material_requirement_reviews')
            ->with([
                'raw_material_requirement_submissions.raw_material_requirement',
                'order_raw_material',
                'price_list',
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");

        if (count($order->raw_material_requirement_submissions) == 0) {
            return Redirect::route('admin.order-quality-management.index')->with('warning', "Order $ref_number does not have any quality submissions made by the buyer!");
        }
        $data['order'] = $order;
        return view('admin.quality.make_review', $data);
    }

    /**
     * Submit a Review
     * @param Request $request
     * @param $ref_number
     * @return array|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function post_review(Request $request, $ref_number) {
        $order = Order::query()
            ->where('ref_number', '=', $ref_number)
            ->with([
                'order_raw_material.raw_material.raw_material_requirements',
                'raw_material_requirement_submissions',
            ])
            ->first();
        if (!$order)
            return Redirect::back()->with('error', "Order Ref: $ref_number not found!");

        $validator = Validator::make($request->all(), [
            'submission_ids' =>  'required',
            'value' =>  'required',
            'submission_ids.*' => 'required|exists:raw_material_requirement_submissions,id',
            'value.*' => 'required',
            'accepted_gross_weight' => 'required|numeric',
            'accepted_net_weight' => 'required|numeric',
            'rejected_gross_weight' => 'required|numeric',
            'rejected_net_weight' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('submission_ids.*')) {
                return  Redirect::back()->withErrors($validator)->withInput()->with('error', "One of the submitted submissions is invalid, refresh page and try again");
            }
            elseif ($validator->errors()->has('value.*')) {
                return  Redirect::back()->withErrors($validator)->withInput()->with('error', "Ensure none of the input fields are left empty");
            }
            else {
                return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
            }
        }

        if ($order->raw_material_requirement_reviews()->exists()){
            return Redirect::route('admin.order-quality-management.index')->with('warning', "$order->ref_number has already been reviewed");
        }

        $values = $request->get('value');
        $admin_id = Auth::guard('admin')->id();
        foreach ($request->get('submission_ids') as $k => $item) {
            $buyer_submission = RawMaterialRequirementSubmission::query()->find($item);
            $buyer_submission->raw_material_requirement_review()->create([
                'order_id'=>$order->id,
                'admin_id'=>$admin_id,
                'value'=>$values[$k],
            ]);
        }
        //add reviewed weights
        $order->order_raw_material()->update([
            'admin_id'=>Auth::guard('admin')->id(),
            'accepted_gross_weight'=>$request->get('accepted_gross_weight'),
            'accepted_net_weight'=>$request->get('accepted_net_weight'),
            'rejected_gross_weight'=>$request->get('rejected_gross_weight'),
            'rejected_net_weight'=>$request->get('rejected_net_weight'),
            'weight_reviewed'=>true,
        ]);
        return Redirect::route('admin.order-quality-management.index')->with('success', "Review for order $order->ref_number has been submitted successfully.");
    }
}
