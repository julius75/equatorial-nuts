<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'status',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'passcode',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'phone_verified_at',
        'passcode',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $appends = ['full_name'];

    public function regions(){
        return $this->belongsToMany(Region::class, 'region_users')
            ->withPivot(['current', 'assigned_by', 'assigned_at', 'created_at', 'updated_at', 'raw_material_id'])
            ->withTimestamps();
    }

    public function current_region(){
        return $this->regions()->where('current', '=', true)->first();
    }

    public function login_token()
    {
        return $this->hasMany(UserLoginToken::class);
    }

    public function activeLoginToken()
    {
        return $this->login_token()
            ->where('verified', '=', true)
            ->where('active', '=', true)
            ->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullNameAttribute(){
        return "$this->first_name $this->last_name";
    }


}
