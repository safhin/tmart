<?php

namespace Database\Seeders;

use App\Models\Cupon;
use Illuminate\Database\Seeder;

class CuponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cupon::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 5000,
        ]);
        Cupon::create([
            'code' => 'DEF456',
            'type' => 'percent_off',
            'percent_off' => 30,
        ]);
    }
}
