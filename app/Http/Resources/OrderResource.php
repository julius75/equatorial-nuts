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
//        {
//            "id": 3,
//            "ref_number": "ENP54981",
//            "user_id": 8,
//            "farmer_id": 1,
//            "price_list_id": 1,
//            "amount": "1803.00",
//            "completed": true,
//            "disbursed": true,
//            "created_at": "2021-04-29 10:03:35",
//            "updated_at": "2021-04-29 10:03:35",
//            "disbursed_at": "2021-05-11 15:20:58",
//            "order_region": { order_region->region->name
//            "id": 1,
//                "order_id": 3,
//                "region_id": 3,
//                "buying_center_id": 17,
//                "latitude": "-0.3667827",
//                "longitude": "35.9429518",
//                "created_at": "2021-04-29 10:03:35",
//                "updated_at": "2021-04-29 10:03:35",
//                "region": {
//                "id": 3,
//                    "name": "Thika",
//                    "county_id": 13,
//                    "sub_county_id": 89,
//                    "created_at": "2021-04-17 07:05",
//                    "updated_at": "2021-05-05 02:49"
//                },
//                "buying_center": {
//                "id": 17,
//                    "region_id": 3,
//                    "name": "Kamwangi",
//                    "created_at": "2021-04-17 07:05",
//                    "updated_at": "2021-04-17 07:05"
//                }
//            },
//            "order_raw_material": {
//            "id": 1,
//                "order_id": 3,
//                "raw_material_id": 1,
//                "bag_type_id": 1,
//                "bags": 1,
//                "gross_weight": "4.0000",
//                "net_weight": "4.0000",
//                "created_at": "2021-04-29 10:03:35",
//                "updated_at": "2021-04-29 10:03:35",
//                "raw_material": {
//                "id": 1,
//                    "name": "CASHEW NUTS",
//                    "created_at": "2021-04-16 12:08",
//                    "updated_at": null
//                }
//            },
//            "farmer": {
//            "id": 1,
//                "full_name": "DEVEINT FARMER",
//                "phone_number": "254725730055",
//                "id_number": "10000001",
//                "gender": "MALE",
//                "region_id": 3,
//                "status": true,
//                "created_at": "2021-04-16 09:08",
//                "updated_at": "2021-05-05 02:31"
//            },
//            "price_list": {
//            "id": 1,
//                "region_id": 3,
//                "raw_material_id": 1,
//                "amount": "901.5",
//                "value": 1,
//                "unit": "kg",
//                "date": "2021-04-19",
//                "created_by": 1,
//                "approved_by": 1,
//                "approved": true,
//                "current": false,
//                "approved_at": "2021-04-21 10:26:36",
//                "created_at": "2021-04-21 07:26:36",
//                "updated_at": "2021-04-21 11:31:32",
//                "status": true
//            },
//            "raw_material_requirement_submissions": [
//                {
//                    "id": 32,
//                    "raw_material_requirement_id": 1,
//                    "value": "7",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                },
//                {
//                    "id": 33,
//                    "raw_material_requirement_id": 2,
//                    "value": "8",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                },
//                {
//                    "id": 34,
//                    "raw_material_requirement_id": 3,
//                    "value": "4",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                },
//                {
//                    "id": 35,
//                    "raw_material_requirement_id": 4,
//                    "value": "12",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                },
//                {
//                    "id": 36,
//                    "raw_material_requirement_id": 5,
//                    "value": "176",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                },
//                {
//                    "id": 37,
//                    "raw_material_requirement_id": 6,
//                    "value": "Good",
//                    "created_at": "2021-04-29 10:18:33",
//                    "updated_at": "2021-04-29 10:18:33",
//                    "order_id": 3
//                }
//            ],
//            "raw_material_requirement_reviews": [
//                {
//                    "id": 13,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 32,
//                    "admin_id": 1,
//                    "value": "9",
//                    "created_at": "2021-05-12 09:50:03",
//                    "updated_at": "2021-05-12 09:50:03"
//                },
//                {
//                    "id": 14,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 33,
//                    "admin_id": 1,
//                    "value": "10",
//                    "created_at": "2021-05-12 09:50:03",
//                    "updated_at": "2021-05-12 09:50:03"
//                },
//                {
//                    "id": 15,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 34,
//                    "admin_id": 1,
//                    "value": "7",
//                    "created_at": "2021-05-12 09:50:03",
//                    "updated_at": "2021-05-12 09:50:03"
//                },
//                {
//                    "id": 16,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 35,
//                    "admin_id": 1,
//                    "value": "17",
//                    "created_at": "2021-05-12 09:50:03",
//                    "updated_at": "2021-05-12 09:50:03"
//                },
//                {
//                    "id": 17,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 36,
//                    "admin_id": 1,
//                    "value": "205",
//                    "created_at": "2021-05-12 09:50:04",
//                    "updated_at": "2021-05-12 09:50:04"
//                },
//                {
//                    "id": 18,
//                    "order_id": 3,
//                    "raw_material_requirement_submission_id": 37,
//                    "admin_id": 1,
//                    "value": "Good",
//                    "created_at": "2021-05-12 09:50:04",
//                    "updated_at": "2021-05-12 09:50:04"
//                }
//            ],
//            "order_raw_material_inventory_review": {
//            "id": 1,
//                "order_id": 3,
//                "admin_id": 1,
//                "raw_material_id": 1,
//                "bag_type_id": 1,
//                "bags": 1,
//                "gross_weight": "3.8900",
//                "net_weight": "3.7600",
//                "created_at": "2021-05-12 05:59:03",
//                "updated_at": "2021-05-12 05:59:03"
//            },
//            "mpesa_disbursement_transaction": null
//        }
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
            'mpesa_disbursement_transaction'=>$this->mpesa_disbursement_transaction,
        ];

    }
}
