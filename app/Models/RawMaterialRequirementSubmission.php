<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialRequirementSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'raw_material_requirement_id',
        'value',
        'order_id',
        'created_at',
        'updated_at',
    ];

    public function raw_material_requirement()
    {
        return $this->belongsTo(RawMaterialRequirement::class);
    }
}
