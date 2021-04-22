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
    public function buyers(){
        return $this->belongsToMany(User::class, 'region_users')
            ->withPivot(['current', 'assigned_by', 'assigned_at', 'created_at', 'updated_at'])
            ->withTimestamps();
    }

}
