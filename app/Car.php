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
        $badge = ($this->alternative_fuel) ? '<span class="badge badge-' . $colors[$this->fuel] . '">' . $this->fuel . '</span>&nbsp<span class="badge badge-' . $colors[$this->alternative_fuel] . '">' . $this->alternative_fuel . '</span> ' : '<span class="badge badge-' . $colors[$this->fuel] . '">' . $this->fuel . '</span> ';
        echo $this->name . ' ' . $badge;
    }

    public function fuelName($q)
    {
        $fuel = [
            "PB" => 'Benzyna <span class="badge badge-success">PB</span>',
            "ON" => 'Ropa <span class="badge badge-danger">ON</span>',
            "LPG" => 'Gaz <span class="badge badge-primary">LPG</span>',
        ];

        echo $fuel[$q];
    }

    public function scopeSort($query, $sort)
    {

        if ($sort == 'mileage-asc') {
            return $query->orderBy('mileage', 'asc');
        } elseif ($sort == 'mileage-desc') {
            return $query->orderBy('mileage', 'desc');
        } elseif ($sort == 'name-asc') {
            return $query->orderBy('name', 'asc');
        } elseif ($sort == 'name-desc') {
            return $query->orderBy('name', 'desc');
        }

        return $query->orderBy('name', 'asc');
    }

    public function scopeSearch($query,$q)
    {
        if ($q == null || $q ==''){
            return $query;
        }
        $q = '%'.$q.'%';

        return $query->where('name','like',$q)
            ->orWhere('fuel','like',$q)
            ->orWhere('alternative_fuel','like',$q);
    }
}
