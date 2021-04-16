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

    public function raw_material_requirements()
    {
        return $this->hasMany(RawMaterialRequirement::class);
    }
    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'farmer_raw_materials');
    }
}
