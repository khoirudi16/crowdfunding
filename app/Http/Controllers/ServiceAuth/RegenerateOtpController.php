<?php

namespace App\Http\Controllers\ServiceAuth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Otp;
use Carbon\Carbon;

class RegenerateOtpController extends Controller
{
    protected $otp_instance;

    public function __construct()
    {
        $this->otp_instance = new Otp();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = $this->_get_user_info($request->email);

        if ($user == null) {
            return response()->json([
                'response_code' => "01",
                'response_message' => 'Email Has not been registered yet',
                'data' => $request->email
            ], 404);
        } else {
            $otp = $this->otp_instance->generate_otp();

            DB::table('otps')->where('userid_fk', $user->userid_pk)->update([
                'otp' => $otp,
                'valid_until' => Carbon::now()->addMinutes(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            event(new UserRegisteredEvent($otp, $user->name, $user->email));

            return response()->json([
                'response_code' => "00",
                'response_message' => 'OTP code has been sent'
            ], 201);
        }
    }

    private function _get_user_info($email)
    {
        $user = DB::table('users')->where('email', $email)->get()->first();
        return $user;
    }
}
