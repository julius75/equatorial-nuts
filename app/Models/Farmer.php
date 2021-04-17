<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone_number',
        'id_number',
        'gender',
        'date_of_birth',
        'region_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i',
        'updated_at' => 'datetime:Y-m-d h:i',
    ];

    protected $hidden = ['pivot', 'date_of_birth'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function raw_materials()
    {
        return $this->belongsToMany(RawMaterial::class, 'farmer_raw_materials');
    }

}
