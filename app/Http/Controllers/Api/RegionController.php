<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Regions
 *
 * API for fetching Equatorial Nut Regions
 *
 */
class RegionController extends Controller
{
    /**
     * List Regions
     *
     * @authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $regions = Region::with(['county:id,name', 'sub_county:id,name'])->get();
        $regions->map(function ($region){
            unset($region->created_at);
            unset($region->updated_at);
            unset($region->county_id);
            unset($region->sub_county_id);
            $region->buying_centers = $region->buying_centers()->select(['id', 'name'])->with('raw_materials:id,name')->get();
        });
        return response()->json(['message'=> compact('regions'), Response::HTTP_OK]);

    }
}
