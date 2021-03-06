<?php

namespace App\Http\Controllers\ServiceAuth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Otp;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public $role_instance;
    public $otp_instance;

    public function __construct()
    {
        $this->role_instance = new Role();
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
            'name' => 'required',
            'email' => 'required|email|max:100|unique:users',
        ]);

        $userid = (string)Str::uuid();
        $get_otp = $this->otp_instance->generate_otp();

        $user = new User();
        $otp = new Otp();

        DB::transaction(function () use ($userid, $get_otp, $user, $otp, $request) {



            $user->userid_pk = $userid;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = null;
            $user->created_at = now();
            $user->updated_at = now();
            $user->roleid_fk = $this->role_instance->get_user_role_id();
            $user->save();

            $otp->otpid_pk = Str::uuid();
            $otp->otp = $get_otp;
            $otp->userid_fk = $userid;
            $otp->valid_until = Carbon::now()->addMinutes(5);
            $otp->created_at = now();
            $otp->save();

            event(new UserRegisteredEvent($get_otp, $user->name, $user->email));
        });

        return response()->json([
            'response_code' => "00",
            'response_message' => 'User Registered successfully',
            'data' => $user
        ], 201);
    }
}
