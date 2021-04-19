<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Raw Materials
 *
 * API for Raw Material Products
 *
 */
class RawMaterialController extends Controller
{
    /**
     * List Raw Materials
     *
     * @authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $raw_materials = RawMaterial::all();
        return response()->json(['message'=> compact('raw_materials'), Response::HTTP_OK]);
    }
}
