<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRawMaterialInventoryReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'admin_id',
        'raw_material_id',
        'bag_type_id',
        'bags',
        'gross_weight',
        'net_weight',
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
    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function bag_type()
    {
        return $this->belongsTo(BagType::class);
    }
    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class);
    }

}
