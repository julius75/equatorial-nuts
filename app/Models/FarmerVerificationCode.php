<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerVerificationCode extends Model
{
    use HasFactory;

    protected $fillable = ['farmer_id', 'passcode', 'issued', 'verified', 'expires_at','created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i',
        'updated_at' => 'datetime:Y-m-d h:i',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

}
