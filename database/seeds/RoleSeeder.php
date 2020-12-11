ae<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;
    use App\Role;

    class RoleSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Id Admin = 'bf04c007-a769-4a16-89d1-ae7bfbfe3490';
            //Id User = '805ba391-02eb-4ef6-9b01-38cf5c1c9bf1';

            Role::create([
                'rolename' => "Administrator",
                'created_at' => now()
            ]);

            Role::create([
                'rolename' => "User",
                'created_at' => now()
            ]);
        }
    }
