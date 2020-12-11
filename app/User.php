<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Traits\Uuid;

class User extends Authenticatable
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
    //         if (!$model->getKey()) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

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

    protected $primaryKey = 'userid_pk';
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
}
