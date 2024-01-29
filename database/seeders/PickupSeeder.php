<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobOrder\Pickup;
use Carbon\Carbon;

class PickupSeeder extends Seeder
{
    public function run()
    {
        // Generate 100 random data for pickup table
        for ($i = 100; $i < 150; $i++) {
            Pickup::create([
                'date_visit' => Carbon::now()->addDays(rand(1, 30))->toDateString(),
                'no_consumen' => 'CON'.rand(1000, 9999),
                'name_consumen' => 'Consumen '.$i,
                'address' => 'Address '.$i,
                'zip_code' => rand(10000, 99999),
                'no_hp' => '081'.rand(10000000, 99999999),
                'is_active' => rand(0, 1),
                'kurir_id' => rand(1, 2),
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

