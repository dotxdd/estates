<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersShift;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => 3,
            'user_firstname' => 'Lars',
            'user_lastname' => 'Urlich',

        ]);
    }
}
