<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\Uuid;

class Otp extends Model
{
    use Uuid;

    protected $guarded = [];

    protected $primaryKey = 'otpid_pk';

    public function generate_otp()
    {
        $generator = "1357902468";
        $result = "";

        for ($i = 1; $i <= 6; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }

    public function get_otp_data($otp)
    {
        $object_otp = DB::table('otps')->where('otp', $otp)->get()->first();
        return $object_otp;
    }
}
