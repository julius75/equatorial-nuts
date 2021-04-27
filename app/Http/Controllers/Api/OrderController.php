<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuyingCenter;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
/**
 * @group Orders
 *
 * @authenticated
 *
 * APIs for listing and creating enp orders/purchases
 *
 */
class OrderController extends Controller
{
    /**
     * List Buyer Orders (Unrefined)
     * @authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_orders(){
        $orders = Order::query()
            ->where('user_id', '=', Auth::id())->with(['order_region','order_raw_material'])
            ->get();
        return response()->json(['message'=>compact('orders')], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     * @authenticated
     *
     * @bodyParam farmer_id integer required Farmer id.
     * @bodyParam price_list_id integer required Price List id used to make calculations.
     * @bodyParam buying_center_id integer required Buying Center id.
     * @bodyParam raw_material_id integer required Raw Material id.
     * @bodyParam bag_type_id integer required Bag Type id.
     * @bodyParam bags integer required Number of Bags Purchased.
     * @bodyParam gross_weight numeric required Gross Weight in KGs.
     * @bodyParam net_weight numeric required Net Weight in KGs.
     * @bodyParam amount numeric required Total Order Amount.
     * @bodyParam latitude numeric required Current Latitude.
     * @bodyParam longitude numeric required Current Longitude.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create_order(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'farmer_id'=>'required|exists:farmers,id',
                'price_list_id'=>'required|exists:price_lists,id',
                'buying_center_id'=>'required|exists:buying_centers,id',
                'raw_material_id'=>'required|exists:raw_materials,id',
                'bag_type_id'=>'required|exists:bag_types,id',
                'bags'=>'required|integer',
                'gross_weight'=>'required|numeric',
                'net_weight'=>'required|numeric',
                'amount'=>'required|numeric',
                'latitude'=>'required|numeric',
                'longitude'=>'required|numeric'
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }

        DB::beginTransaction();
        try {
            $order = Order::query()->create([
                'ref_number'=>$this->generateRefNumber(),
                'user_id'=>Auth::id(),
                'farmer_id'=>$request->get('farmer_id'),
                'amount'=>$request->get('amount'),
                'price_list_id'=>$request->get('price_list_id'),
                'issued'=>false,
                'disbursed'=>false,
            ]);

            $buying_center = BuyingCenter::query()->find($request->get('buying_center_id'));

            $order->order_region()->create([
                'buying_center_id'=>$buying_center->id,
                'region_id'=>$buying_center->region_id,
                'latitude'=>$request->get('latitude'),
                'longitude'=>$request->get('longitude'),
            ]);

            $order->order_raw_material()->create([
                'raw_material_id'=>$request->get('raw_material_id'),
                'bags'=>$request->get('bags'),
                'gross_weight'=>$request->get('gross_weight'),
                'net_weight'=>$request->get('net_weight'),
            ]);
            DB::commit();

            $order = $order->with(['order_region','order_raw_material']);
            return response()->json(['message' =>"Order Details Recorded Successfully!",compact('order')], Response::HTTP_OK);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['message' =>"Order failed tobe recorded", 'exception'=>$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @return string
     */
    protected function generateRefNumber()
    {
        $ref_number = 'ENP'.mt_rand(10000, 99999);
        while ($this->check_RefNumber_exists($ref_number)) {
            $ref_number = 'ENP'.mt_rand(10000, 99999);
        }
        return $ref_number;
    }
    /**
     * @param int $ref_number
     * @return mixed
     */
    protected function check_RefNumber_exists(int $ref_number)
    {
        return Order::query()->where('ref_number','=',$ref_number)->exists();
    }
}
