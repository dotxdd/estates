<?php

namespace Database\Seeders;

use App\Models\Estate;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estate::create([
            'id' => 100,
            'supervisor_user_id' => 2, //dane do przetestowania funckji finalnie po odpaleniu ten rekord bedzie mial tu id 3
            'street' => 'Dąbrowskiego',
            'building_number' => 322,
            'city' => 'Kielnarowa',
            'zip' => '89-200' ,

        ]);
    }
}
