<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use APp\Traits\Uuid;

class Otp extends Model
{
    use Uuid;

    protected $guarded = [];
}
