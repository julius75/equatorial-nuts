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


}
