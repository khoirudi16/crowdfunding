<?php

namespace App\Http\Controllers\ServiceAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\DB;

class UpdatePasswordOtpController extends Controller
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
            'email' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $user_info = $this->_get_user_info($request->email);

        if ($user_info == null) {
            return response()->json([
                'response_code' => "01",
                'response_message' => 'Email not found, Please use valid email',
                'data' => $request->email
            ], 404);
        } else {
            DB::table('users')->where('userid_pk', $user_info->userid_pk)->update([
                'password' => bcrypt($request->password),
                'updated_at' => now()
            ]);

            return response()->json([
                'response_code' => "00",
                'response_message' => 'Password has been updated',
                'data' => $user_info
            ], 201);
        }
    }

    private function _get_user_info($email)
    {
        $user = DB::table('users')->where('email', $email)->get()->first();
        return $user;
    }
}
