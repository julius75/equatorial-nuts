<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FarmerResource;
use App\Jobs\SendSMS;
use App\Models\Farmer;
use App\Models\FarmerVerificationCode;
use Carbon\Carbon;
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
     * @bodyParam region_id integer required Region ID.
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

            $code = $farmer->verification_codes()->create([
                'passcode'=>$this->generate_OTP(),
                'issued'=>true,
                'expires_at'=>Carbon::now()->addMinutes(10),
            ]);

            //send otp
            SendSMS::dispatch($farmer->phone_number, "Your Equatorial Nut Farmer Verification Token is: $code->passcode");
            $farmer_details = [
                'id'=>$farmer->id,
                'full_name'=>$farmer->full_name,
                'id_number'=>$farmer->id_number,
                'phone_number'=>$farmer->phone_number
            ];
            return response()->json(['message'=> "$farmer->full_name registered successfully", compact('farmer_details')],Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['message'=> "Failed to Register Farmer, Refresh page and try again"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Verify Farmer's Phone Number
     *
     * @authenticated
     *
     * @bodyParam farmer_id integer required Farmer's id received after successful registration.
     * @bodyParam passcode integer required OTP.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_OTP(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'farmer_id' => 'required|exists:farmers,id',
                'passcode' => 'required|exists:farmer_verification_codes,passcode',
            ]);
        if ($validator->fails())
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

        $farmer = Farmer::find($request->farmer_id);
        $code = $farmer->verification_codes()->where('passcode', '=', $request->passcode)->first();
        if (!$code){
            return response()->json(['message' => 'Invalid OTP'], Response::HTTP_NOT_FOUND);
        }
        else if ($code->verified == true) {
            return response()->json(['message' => 'Phone Number Already Verified'], Response::HTTP_OK);
        }
        else if (Carbon::now() > Carbon::parse($code->expires_at)){
            return response()->json(['message' => 'OTP has expired, resend OTP'], Response::HTTP_NOT_FOUND);
        }
        else if ($code->verified == false){
            $code->update([
                'verified'=>true,
                'updated_at'=>now()
            ]);
            return response()->json(['message' => 'Phone Number Verified Successfully'], Response::HTTP_OK);
        }
        else{
            return response()->json(['message'=> "Failed to Verify OTP, Refresh page and try again"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Resend OTP
     *
     * @authenticated
     *
     * @bodyParam farmer_id integer required Farmer's id received after successful registration.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend_OTP(Request $request){
        $validator = Validator::make($request->all(),
            [
                'farmer_id' => 'required|exists:farmers,id'
            ]);
        if ($validator->fails())
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

        $farmer = Farmer::find($request->farmer_id);
        $code = FarmerVerificationCode::query()
            ->where('farmer_id', '=', $request->farmer_id)
            ->where('verified', '=', false)
            ->first();
        if (!$code){
            return response()->json(['message' => 'Farmer Does Not have an unverified OTP'], Response::HTTP_NOT_FOUND);
        }else{
            //send otp
            $code->update([
                'expires_at' => now()->addMinutes(10)
            ]);
            SendSMS::dispatch($farmer->phone_number, "Your Equatorial Nut Farmer Verification Token is: $code->passcode");
            return response()->json(['message' => 'OTP Resent'], Response::HTTP_OK);
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

    /**
     * @return integer
     */
    protected function generate_OTP()
    {
        $otp = mt_rand(1000, 9999);
        while ($this->check_OTP_exists($otp)) {
            $otp = mt_rand(1000, 9999);
        }
        return $otp;
    }

    /**
     * @param int $otp
     * @return mixed
     */
    protected function check_OTP_exists(int $otp)
    {
        return FarmerVerificationCode::query()->where('passcode','=',$otp)->exists();
    }


}
