<?php

namespace App\Http\Resources;

use App\Models\FarmerVerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FarmerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_verified = FarmerVerificationCode::query()
            ->where('farmer_id', '=', $this->id)
            ->where('verified', '=', true)
            ->exists();
        return [
            'id'=>$this->id,
            'full_name'=>$this->full_name,
            'phone_number'=>$this->phone_number,
            'phone_number_verified'=>$is_verified,
            'id_number'=>$this->id_number,
            'gender'=>$this->gender,
            'region'=>$this->region,
            'raw_materials'=>$this->raw_materials,
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d h:i:s'),
        ];
    }
}
