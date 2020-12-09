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
        //Insert Admin User
        DB::table('users')->insert([
            'userid_pk' => Str::uuid(),
            'name' => 'Super Admin CF',
            'email' => 'sa@gmail.com',
            'password' => bcrypt('Dummy123!'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(50),
            'roleid_fk' => "bf04c007-a769-4a16-89d1-ae7bfbfe3490",
            'created_at' => now()
        ]);

        // \App\User::create([

        //     'name' => 'Anak Paman',
        //     'email' => 'paman@gmail.com',
        //     'password' => bcrypt('Dummy123'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(50),
        //     'roleid_fk' => Str::uuid()
        // ]);
    }
}
