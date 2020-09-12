<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    public function repair()
    {
        return $this->hasOne('App\Repair', 'id', 'repair_id');
    }

    public function repairs()
    {
        return $this->hasMany('App\Repair', 'id', 'repair_id');
    }

    public function scopeSort($query, $sort)
    {
        if ($sort == "mileage-asc") {
            return $query->orderBy('mileage', 'asc')->orderBy('created_at', 'DESC');
        }
        if ($sort == "mileage-desc") {
            return $query->orderBy('mileage', 'desc')->orderBy('created_at', 'DESC');
        }
        if ($sort == "value-asc") {
            return $query->orderBy('value', 'asc')->orderBy('created_at', 'DESC');
        }
        if ($sort == "value-desc") {
            return $query->orderBy('value', 'desc')->orderBy('created_at', 'DESC');
        }
        if ($sort == "created_at-asc") {
            return $query->orderBy('created_at', 'asc');
        }
        if ($sort == "created_at-desc") {
            return $query->orderBy('created_at', 'desc');
        }

        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeDates($query, $request)
    {

        if (isset($request->from) && isset($request->to)) {
            $from = ($request->from) ? new Carbon($request->from) : null;
            $to = ($request->to) ? new Carbon($request->to) : null;
            if ($from && $to){
                return $query->where('created_at', '>=', $from->startOfDay())->where('created_at', '<=', $to->endOfDay());
            }elseif ($from){
                return $query->where('created_at', '>=', $from->startOfDay());
            }elseif ($to){
                return $query->where('created_at', '<=', $to->endOfDay());
            }
        }
        return $query;

    }
}
