<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    use HasFactory;

    protected $fillable = [
        'county_id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

}
