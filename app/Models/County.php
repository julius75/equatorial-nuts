<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capital',
        'code',
        'created_at',
        'updated_at',
    ];

    public function subCounties()
    {
        return $this->hasMany(SubCounty::class);
    }
}
