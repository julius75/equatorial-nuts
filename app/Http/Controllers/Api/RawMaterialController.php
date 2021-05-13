<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RawMaterial;
use App\Models\RawMaterialRequirementSubmission;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Raw Materials
 *
 * API for Raw Material Products
 *
 */
class RawMaterialController extends Controller
{
    /**
     * List all Raw Materials
     *
     * @authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $raw_materials = RawMaterial::all();
        return response()->json(['message'=> compact('raw_materials')], Response::HTTP_OK);
    }
    /**
     * Fetch Raw Materials Current Price
     *
     * Returns Prices of all raw materials within the buyers specified region
     *
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch_price()
    {
        $buyer = Auth::user();
        $get_current_assignment = DB::table('region_users')
            ->where('current', '=', true)
            ->where('user_id', '=', $buyer->id)
            ->first();
        if (!$get_current_assignment)
            return response()->json(['message'=> 'You are yet to be assigned to a region/raw material contact Admin'], Response::HTTP_BAD_REQUEST);
        $raw_material = RawMaterial::query()
            ->where('id', '=', $get_current_assignment->raw_material_id)
            ->whereHas('currentPrice',function ($q) use ($get_current_assignment){
                $q->where('region_id', '=', $get_current_assignment->region_id);
            })->with(['currentPrice:id,raw_material_id,region_id,amount,value,unit,date,approved_at,created_at'])
            ->first();
        if ($raw_material){
            return response()->json(['message'=> compact('raw_material')], Response::HTTP_OK);
        }else{
            return response()->json(['message' =>  'No Raw Material Price has been listed in your region'], Response::HTTP_UNAUTHORIZED);
        }

    }

    /**
     * Fetch Raw Materials Specifications
     *
     * Returns Specifications of the desired Raw Material
     *
     * @authenticated
     * @bodyParam raw_material_id integer required Raw Material ID.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch_requirements(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'raw_material_id' => 'required|exists:raw_materials,id'
            ]);
        if ($validator->fails())
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        $raw_material = RawMaterial::query()
                        ->where('id', '=', $request->raw_material_id)
                        ->with('raw_material_requirements')
                        ->first();
        return response()->json(['message'=> compact('raw_material')], Response::HTTP_OK);
    }

    /**
     * Submit Raw Material Requirement Submission
     *
     *
     * @authenticated
     * @bodyParam order_id integer required Order ID.
     * @bodyParam submissions object required Array of objects containing the submissions eg. [{"raw_material_requirement_id":1, "value":0.95}, {"raw_material_requirement_id":2, "value":"spherical shapes"}].
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create_raw_material_requirements_submission(Request $request){
        $validator = Validator::make($request->all(),
            [
                'order_id'=>'required|exists:orders,id',
                'submissions' => 'required|array|min:1',
                'submissions.*.raw_material_requirement_id' => 'required|exists:raw_material_requirements,id',
                'submissions.*.value' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $order = Order::query()->find($request->get('order_id'));
        try {
            foreach ($request->get('submissions') as $item) {
                $check = RawMaterialRequirementSubmission::query()
                    ->where(['order_id'=>$order->id, 'raw_material_requirement_id'=>$item['raw_material_requirement_id']])->first();
                if ($check){
                    $check->delete();
                    RawMaterialRequirementSubmission::query()->create([
                        'order_id'=>$order->id,
                        'raw_material_requirement_id'=>$item['raw_material_requirement_id'],
                        'value'=>$item['value'],
                    ]);
                } else
                    {
                    RawMaterialRequirementSubmission::query()->create([
                        'order_id'=>$order->id,
                        'raw_material_requirement_id'=>$item['raw_material_requirement_id'],
                        'value'=>$item['value'],
                    ]);
                }
            }
            return response()->json(['message'=> "Quality Submissions for $order->ref_number registered successfully"],Response::HTTP_OK);
        }
        catch (\Exception $exception) {
            return response()->json(['message'=> "Failed to register Quality Submissions", 'exception'=>$exception],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * View an Order Details + Raw Material Requirement Submissions
     *
     * @authenticated
     * @bodyParam order_id integer required Order ID.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view_raw_material_requirements_submission(Request $request){
        $validator = Validator::make($request->all(),
            [
                'order_id'=>'required|exists:orders,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $order = Order::query()
            ->with(['user','farmer','price_list','order_raw_material','order_region'])
            ->find($request->get('order_id'));
        $orderSubmissions = $order->raw_material_requirement_submissions()->with('raw_material_requirement');
        return response()->json(['message'=> compact('order', 'orderSubmissions')],Response::HTTP_OK);

    }

}
