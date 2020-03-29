<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function repair()
    {
        return $this->belongsTo('App\Repair');
    }
}
