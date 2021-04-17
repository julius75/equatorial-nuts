<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'buying_center',
        'county_id',
        'sub_county_id',
        'created_at',
        'updated_at',
    ];

    public function buying_centers()
    {
        return $this->hasMany(BuyingCenter::class);
    }
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function sub_county()
    {
        return $this->belongsTo(SubCounty::class);
    }

}
