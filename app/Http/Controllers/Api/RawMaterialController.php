<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $buyerRegion = $buyer->current_region();
        if (!$buyerRegion)
            return response()->json(['message'=> 'You are yet to be assigned to a region, contact Admin'], Response::HTTP_BAD_REQUEST);

        $raw_materials = RawMaterial::query()
            ->whereHas('currentPrice',function ($q) use ($buyerRegion){
                $q->where('region_id', '=', $buyerRegion->id);
            })->with(['currentPrice:raw_material_id,region_id,amount,amount,value,unit,date,approved_at,created_at'])->get();
        return response()->json(['message'=> compact('raw_materials')], Response::HTTP_OK);
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

}
