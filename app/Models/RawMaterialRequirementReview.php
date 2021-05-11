<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialRequirementReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'raw_material_requirement_submission_id',
        'order_id',
        'admin_id',
        'value',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    public function raw_material_requirement_submission()
    {
        return $this->belongsTo(RawMaterialRequirementSubmission::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
