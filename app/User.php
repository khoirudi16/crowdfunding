<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Traits\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Uuid;

    /**
     * The "booting" function of model
     *
     * @return void
     */
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->roleid_fk = $model->get_user_role_id();
    //         // if (!$model->getKey()) {
    //         //     $model->{$model->getKeyName()} = (string) Str::uuid();
    //         // }
    //     });
    // }

    protected $primaryKey = 'userid_pk';
    protected $primary = 'userid_pk';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roleid_fk'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin()
    {
        $getIdAdmin = DB::table('roles')->where('rolename', 'Administrator')->first()->roleid_pk;

        if ($this->roleid_fk == $getIdAdmin) {
            return true;
        }
        return false;
    }

    public function checkMailVerification()
    {
        if ($this->email_verified_at == null) {
            return false;
        }
        return true;
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    // public function getIncrementing()
    // {
    //     return false;
    // }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    // public function getKeyType()
    // {
    //     return 'string';
    // }
}
