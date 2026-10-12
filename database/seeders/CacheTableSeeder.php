<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CacheTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cache')->delete();
        
        \DB::table('cache')->insert(array (
            0 => 
            array (
                'key' => 'laravel-cache-c6be2cf7c13d9a527ee2fe401bbae3c7',
                'value' => 'i:4;',
                'expiration' => 1791787057,
            ),
            1 => 
            array (
                'key' => 'laravel-cache-c6be2cf7c13d9a527ee2fe401bbae3c7:timer',
                'value' => 'i:1791787057;',
                'expiration' => 1791787057,
            ),
        ));
        
        
    }
}