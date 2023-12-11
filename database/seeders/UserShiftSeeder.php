<?php

namespace Database\Seeders;

use App\Models\UsersShift;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsersShift::create([
            'user_id' => 1,
            'substitute_user_id' => 2,
            'date_from' => Carbon::now()->subDays(5)->toDateString(),
            'date_to' => Carbon::now()->addDays(5)->toDateString(),
        ]);
    }
}
