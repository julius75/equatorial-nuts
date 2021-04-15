<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialRequirement extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_id',
        'parameter',
        'type',
        'value',
        'requirement',
        'unit',
        'created_at',
        'updated_at',
    ];

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
