<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['pivot'];

    public function raw_material_requirements()
    {
        return $this->hasMany(RawMaterialRequirement::class);
    }
    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'farmer_raw_materials');
    }
    public function buying_centers()
    {
        return $this->belongsToMany(BuyingCenter::class, 'buying_center_raw_materials');
    }
}
