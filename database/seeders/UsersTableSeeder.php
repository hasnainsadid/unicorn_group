<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Hasnain Sadid',
                'email' => 'hasnainsadid@gmail.com',
                'phone' => NULL,
                'email_verified_at' => NULL,
                'password' => '$2y$12$BE4wNWVUVZy65xXKduyiX.LhwN3WWVLx..f4nk3wLASHZ0zHYRx6.',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2026-10-12 06:38:20',
                'updated_at' => '2026-10-12 06:38:20',
            ),
        ));
        
        
    }
}