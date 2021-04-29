<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTimeoutResponse extends Model
{
    use HasFactory;
    protected $fillable = ['response', 'created_at', 'updated_at'];
}
