<?php

namespace App\Http\Controllers\ServiceAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;


class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $object_otp = $this->_get_otp_data($request->otp);

        if ($object_otp == null) {
            return response()->json([
                'response_code' => "01",
                'response_message' => 'OTP is invalid',
                'data' => $request->otp
            ], 404);
        } else {
            if (strtotime(now()) > strtotime($object_otp->valid_until)) {
                return response()->json([
                    'response_code' => "01",
                    'response_message' => 'OTP is expired, Please regenerate otp code'
                ]);
            } else {
                $user = User::find($object_otp->userid_fk);

                $user->email_verified_at = now();

                $user->save();

                return response()->json([
                    'response_code' => "00",
                    'response_message' => 'Email Has been verified',
                    'data' => $user
                ], 201);
            }
        }
    }

    private function _get_otp_data($otp)
    {
        $object_otp = DB::table('otps')->where('otp', $otp)->get()->first();
        return $object_otp;
    }
}
