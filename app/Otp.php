<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Otp extends Model
{
    use Uuid;

    protected $guarded = [];

    protected $primaryKey = 'otpid_pk';
}
