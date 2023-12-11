<?php

namespace Database\Seeders;

use App\Models\UsersShift;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserShiftSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tempChangesArray = [100];

        UsersShift::create([
            'user_id' => 3,
            'substitute_user_id' => 2,
            'date_from' => Carbon::now()->subDays(5)->toDateString(),
            'date_to' => Carbon::now()->subDays(2)->toDateString(),
            'temp_changes' => json_encode($tempChangesArray),
        ]);
    }
}
