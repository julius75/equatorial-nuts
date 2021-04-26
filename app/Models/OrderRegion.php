<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRegion extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'region_id',
        'buying_center_id',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function buying_center()
    {
        return $this->belongsTo(BuyingCenter::class);
    }
}
