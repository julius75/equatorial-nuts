<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'region_id',
        'name',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['pivot'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i',
        'updated_at' => 'datetime:Y-m-d h:i',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function raw_materials()
    {
        return $this->belongsToMany(RawMaterial::class, 'buying_center_raw_materials');
    }
}
