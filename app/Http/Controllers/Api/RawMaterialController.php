<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\RawMaterial;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

}
