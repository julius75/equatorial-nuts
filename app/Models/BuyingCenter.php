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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
