<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'userid_pk' => Str::uuid(),
        //     'name' => 'Muhammad Khoirudin',
        //     'email' => 'khoirudi16@gmail.com',
        //     'password' => bcrypt('Dummy123'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(50),
        //     'roleid_fk' => Str::uuid(),
        //     'created_at' => now()
        // ]);

        \App\User::create([

            'name' => 'Anak Paman',
            'email' => 'paman@gmail.com',
            'password' => bcrypt('Dummy123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(50),
            'roleid_fk' => Str::uuid()
        ]);
    }
}
