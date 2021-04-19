<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'region_id',
        'raw_material_id',
        'date',
        'amount',
        'value',
        'unit',
        'approved',
        'created_by',
        'approved_by',
        'approved_at',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
