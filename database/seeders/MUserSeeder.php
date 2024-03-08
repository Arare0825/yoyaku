<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MUser;
use Illuminate\Support\Facades\Hash;

class MUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MUser::create(
            [
            'hid' => 'admin',
            'facility_id' => '0000',
            'user_id' => 'admin',
            'password' => Hash::make("password123"),
            'user_type' => '0',
            ]);
            MUser::create([
            'hid' => 'user01',
            'facility_id' => '0001',
            'user_id' => 'user01',
            'password' => Hash::make("password123"),
            'user_type' => '1',
            ]);
            MUser::create([
            'hid' => 'user01',
            'facility_id' => '0001',
            'user_id' => 'test02',
            'password' => Hash::make("password123"),
            'user_type' => '2',
            ]);


    
    }
}
