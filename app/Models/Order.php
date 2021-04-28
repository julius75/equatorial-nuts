<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_number',
        'user_id',
        'farmer_id',
        'price_list_id',
        'amount',
        'completed',
        'disbursed',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
    public function price_list()
    {
        return $this->belongsTo(PriceList::class);
    }
    public function order_raw_material()
    {
        return $this->hasOne(OrderRawMaterial::class);
    }
    public function order_region()
    {
        return $this->hasOne(OrderRegion::class);
    }
    public function raw_material_requirement_submissions()
    {
        return $this->hasMany(RawMaterialRequirementSubmission::class);
    }
    public function mpesa_disbursement_request()
    {
        return $this->hasOne(MpesaDisbursementRequest::class);
    }
    public function scopeDisbursed($query){
        $query->where('disbursed', true);
    }
    public function scopeComplete($query){
        $query->where('complete', true);
    }

}
