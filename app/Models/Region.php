<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'county_id',
        'sub_county_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'pivot'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i',
        'updated_at' => 'datetime:Y-m-d h:i',
    ];
    public function buying_centers()
    {
        return $this->hasMany(BuyingCenter::class);
    }
    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function sub_county()
    {
        return $this->belongsTo(SubCounty::class);
    }
    public function buyers()
    {
        return $this->belongsToMany(User::class, 'region_users')
            ->withPivot(['current', 'assigned_by', 'assigned_at', 'created_at', 'updated_at', 'raw_material_id'])
            ->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany(OrderRegion::class);
    }

}
