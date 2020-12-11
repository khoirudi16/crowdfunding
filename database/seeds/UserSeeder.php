<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert Admin User
        User::create([
            // 'userid_pk' => Str::uuid(),
            'name' => 'Super Admin CF',
            'email' => 'sa@gmail.com',
            'password' => bcrypt('Dummy123!'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(50),
            'roleid_fk' => "db1ebe8d-ccb7-449c-8b63-6070be465424",
            'created_at' => now()
        ]);
    }
}
