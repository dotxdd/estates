<?php

declare(strict_types=1);

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps=false;
    protected $fillable= [
        'user_id', 'user_firstname', 'user_lastname'
    ];

    public function estates()
    {
        return $this->hasMany(Estate::class, 'supervisor_user_id', 'user_id');
    }

}
