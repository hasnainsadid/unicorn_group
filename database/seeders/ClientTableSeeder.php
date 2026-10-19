<?php
namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::truncate();

        $names = ['CLIENT ONE', 'NORTHWIND', 'BLUE ORBIT', 'SKYLINE CO.', 'METRO HUB', 'GREENFIELD', 'ATLAS BUILD', 'URBAN EDGE'];

        foreach ($names as $i => $name) {
            Client::create(['name' => $name, 'sort_order' => $i + 1]);
        }
    }
}
