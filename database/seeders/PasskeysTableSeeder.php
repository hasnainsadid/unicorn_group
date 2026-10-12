<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasskeysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('passkeys')->delete();
        
        
        
    }
}