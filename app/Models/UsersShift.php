<?php

declare(strict_types=1);

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UsersShift extends Model
{
    public $timestamps=false;
    protected $fillable= [
        'id','user_id', 'substitute_user_id', 'temp_changes', 'date_from', 'date_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function substituteUser()
    {
        return $this->belongsTo(User::class, 'substitute_user_id', 'user_id');
    }

    public static function temporarySupervisors():void
    {
        $now = Carbon::now()->toDateString();

        $activeShifts = self::whereDate('date_from', '<=', $now)
            ->whereDate('date_to', '>=', $now)
            ->whereNull('temp_changes')
            ->get();


        foreach ($activeShifts as $shift) {
            $estatesToUpdate = Estate::where('supervisor_user_id', $shift->user_id)->get();
            $estateIds = $estatesToUpdate->pluck('id')->toArray();
            $shift->temp_changes = json_encode($estateIds);
            $shift->save();

            foreach ($estatesToUpdate as $estate) {
                $estate->supervisor_user_id = $shift->substitute_user_id;
                $estate->save();
            }

        }

    }

    public static function revertTemporarySupervisors():void
    {
        $now = Carbon::now()->toDateString();

        $unactiveShifts = self::whereDate('date_to', '<', $now)
            ->whereNotNull('temp_changes')
            ->get();

        foreach ($unactiveShifts as $shift) {
            $estateIds = json_decode($shift->temp_changes);

            foreach ($estateIds as $estateId) {
                $estate = Estate::find($estateId);

                if ($estate) {
                    $estate->supervisor_user_id = $shift->user_id;
                    $estate->save();
                }
            }

            $shift->temp_changes = null;
            $shift->save();
            //operacja powyzej nie ma sensu jesli usuwamy rekord, nie bylem pewny co z tym wpisam ma sie dziac wiec takie 2 opcje zrobilem
            $shift->delete();
        }
    }

}
