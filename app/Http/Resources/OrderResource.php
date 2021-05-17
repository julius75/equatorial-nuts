<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'ref_number'=>$this->ref_number,
            'amount'=>$this->amount,
            'disbursed'=>$this->disbursed,
            'created_at'=>$this->created_at,
            'disbursed_at'=>$this->disbursed_at,
            'region'=>$this->order_region->region->name,
            'buying_center'=>$this->order_region->buying_center->name,
            'raw_material_details'=>$this->order_raw_material,
            'farmer_details'=>$this->farmer,
            'order_quality_submission'=>$this->raw_material_requirement_submissions,
            'order_raw_material_inventory_review'=>$this->order_raw_material_inventory_review,
            'order_raw_material_quality_reviews'=>$this->raw_material_requirement_reviews,
            'mpesa_disbursement_transaction'=>$this->mpesa_disbursement_transaction,
        ];

    }
}
