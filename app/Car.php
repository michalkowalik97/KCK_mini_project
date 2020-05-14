<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'photo', 'mileage', 'user_id', 'reminder_id'];

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    public function scopeUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function renderName()
    {
        $colors = [
            "PB" => 'success',
            "ON" => 'danger',
            "LPG" => 'primary',
        ];
        $badge = ($this->alternative_fuel) ? '<br/><span class="badge badge-'.$colors[$this->fuel].'">'.$this->fuel.'</span>&nbsp<span class="badge badge-'.$colors[$this->alternative_fuel].'">'.$this->alternative_fuel.'</span> ' : '<br/><span class="badge badge-'.$colors[$this->fuel].'">'.$this->fuel.'</span>';
        echo $this->name.' '.$badge;
    }
}
