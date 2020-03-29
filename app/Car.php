<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    protected $fillable = ['name', 'photo', 'mileage', 'user_id', 'reminder_id'];

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    public function scopeUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

}
