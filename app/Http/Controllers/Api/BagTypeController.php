<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BagType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Bag Types
 *
 * API for fetching Bag Types
 *
 */
class BagTypeController extends Controller
{
    /**
     * List Bag Types
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $types = BagType::all();
        $types->map(function ($type) {
            unset($type->created_at);
            unset($type->updated_at);
        });
        return response()->json(['message'=> compact('types')], Response::HTTP_OK);
    }
}
