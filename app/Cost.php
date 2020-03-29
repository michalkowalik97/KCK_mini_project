<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    public function repair()
    {
        return $this->hasOne('App\Repair');
    }
}
