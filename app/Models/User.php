<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone_number',
        'is_admin',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type_id'      => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function productCategories()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }

    public function brands()
    {
        return $this->hasMany('App\Models\Brand');
    }
    
    public function sizes()
    {
        return $this->hasMany('App\Models\Size');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }
    
    public function userType()
    {
        return $this->belongsTo('App\Models\UserType');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    //check if user is an admin
    public function isAdmin()
    {
       return $this->userType()->where('name', 'Admin')->exists();
    }

    public function isEmployee()
    {
       return $this->userType()->where('name', 'Employee')->exists();
    }
}
