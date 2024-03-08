<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MHotel;

class MHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MHotel::create(
            [
            'hid' => 'admin',
            ]);
        MHotel::create(
            [
            'hid' => 'test01',
            ]);
    
    }
}
