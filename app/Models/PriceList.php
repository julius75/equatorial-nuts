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
        'current',
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
    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
}
