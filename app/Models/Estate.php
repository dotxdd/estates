<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Estate extends Model
{
    public $timestamps=false;
    protected $fillable= [
        'id', 'supervisor_user_id', 'street', 'building_number', 'city', 'zip'
    ];
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_user_id', 'user_id');
    }
}
