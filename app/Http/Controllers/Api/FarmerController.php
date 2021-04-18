<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FarmerResource;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Farmers
 *
 * @authenticated
 *
 * APIs for listing and creating farmers
 */
class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @authenticated
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $farmers = Farmer::with(['region:id,name','raw_materials:id,name'])
            ->where('status', '=', true)
            ->orderByDesc('created_at')
            ->paginate(20);
        return FarmerResource::collection($farmers);
    }

    /**
     * Store a newly created resource in storage.
     * @authenticated
     *
     * @bodyParam full_name string required Full Name.
     * @bodyParam phone_number string required PhoneNumber '254*********'.
     * @bodyParam id_number string required ID Number.
     * @bodyParam gender string required MALE/FEMALE.
     * @bodyParam date_of_birth date required Date of Birth.
     * @bodyParam region_id integer required Date of Birth.
     * @bodyParam raw_material_ids object required Array of Raw Material IDs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'full_name'=>'required',
                'phone_number' => 'required|unique:farmers',
                'id_number' => 'required|unique:farmers',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'region_id' => 'required|exists:regions,id',
                'raw_material_ids.*' => 'required|exists:raw_materials,id',
            ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('raw_material_ids.*'))
                return response()->json(['message' =>  'One of the Selected Raw Materials is invalid'], Response::HTTP_BAD_REQUEST);
            else
                return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        try{
            $farmer = Farmer::create([
                'full_name'=>$request->full_name,
                'phone_number'=>$request->phone_number,
                'id_number'=>$request->id_number,
                'gender'=>strtoupper($request->gender),
                'region_id'=>$request->region_id,
                'date_of_birth'=>$request->date_of_birth,
            ]);

            $farmer->raw_materials()->sync($request->raw_material_ids, true);

            return response()->json(['message'=> "$farmer->full_name registered successfully", Response::HTTP_OK]);
        }catch (\Exception $e){
            return response()->json(['message'=> "Failed to Register Farmer, Refresh page and try again", Response::HTTP_BAD_REQUEST]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @authenticated
     *
     * @urlParam farmer integer required Farmer Id
     *
     * @param  int  $id
     * @return FarmerResource
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $farmer = Farmer::with(['region:id,name','raw_materials:id,name'])
            ->where('status', '=', true)
            ->where('id', '=', $id)
            ->first();
        if ($farmer)
            return new FarmerResource($farmer);
        else
            return response()->json(['message' => "Farmer Not Found"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Search For a Farmer
     *
     * Query can be: Phone Number, Full Name or Id Number
     *
     * @authenticated
     *
     * @bodyParam search_query string required Search Query.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     */
    public function search(Request $request){
        $validator = Validator::make($request->all(),
            [
                'search_query'=>'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }

        $farmers = Farmer::query()
            ->where('status','=',true)
            ->where('full_name', 'ILIKE', "%{$request->search_query}%")
            ->orWhere('id_number', 'LIKE', "%{$request->search_query}%")
            ->orWhere('phone_number', 'LIKE', "%{$request->search_query}%")
            ->with(['region:id,name','raw_materials:id,name'])
            ->orderByDesc('created_at')
            ->get();

        return FarmerResource::collection($farmers);
    }

    /**
     * Filter Farmers by region
     *
     * Gets Farmers within a specified region
     *
     * @authenticated
     *
     * @bodyParam region_id integer required Search Query.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filter(Request $request){
        $validator = Validator::make($request->all(),
            [
                'region_id'=>'required|exists:regions,id',
            ]);
        if($validator->fails())
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

        $farmers = Farmer::query()
            ->where('status','=',true)
            ->where('region_id', '=', $request->region_id)
            ->with(['region:id,name','raw_materials:id,name'])
            ->orderByDesc('created_at')
            ->get();

        return FarmerResource::collection($farmers);
    }



}
