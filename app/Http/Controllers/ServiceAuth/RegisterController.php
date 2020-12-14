<?php

namespace App\Http\Controllers\ServiceAuth;

use App\Http\Controllers\Controller;
use App\Otp;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
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
            'name' => 'required',
            'email' => 'required|email|max:100|unique:users',
        ]);

        $userid = (string)Str::uuid();

        $user = new User();
        $otp = new Otp();

        DB::transaction(function () use ($userid, $user, $otp, $request) {

            $user->userid_pk = $userid;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = null;
            $user->created_at = now();
            $user->updated_at = now();
            $user->roleid_fk = $this->get_user_role_id();
            $user->save();

            $otp->otpid_pk = Str::uuid();
            $otp->otp = $this->_generate_otp();
            $otp->userid_fk = $userid;
            $otp->valid_until = Carbon::now()->addMinutes(5);
            $otp->created_at = now();
            $otp->save();
        });



        return response()->json([
            'response_code' => "00",
            'response_message' => 'User Registered successfully',
            'data' => $user
        ], 201);
    }

    private function _generate_otp()
    {
        $generator = "1357902468";
        $result = "";

        for ($i = 1; $i <= 6; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result 
        return $result;
    }

    public function get_user_role_id()
    {
        $role = DB::table('roles')->where('rolename', 'user')->get()->first();
        return $role->roleid_pk;
    }
}
