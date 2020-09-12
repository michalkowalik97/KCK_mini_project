<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    public function scopeSort($query, $sort)
    {
        if ($sort == 'value-asc') {
            return $query->orderBy('value','asc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'value-desc') {
            return $query->orderBy('value','desc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'quantity-asc') {
            return $query->orderBy('quantity','asc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'quantity-desc') {
            return $query->orderBy('quantity','desc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'price-asc') {
            return $query->orderBy('price','asc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'price-desc') {
            return $query->orderBy('price','desc')->orderBy('created_at', 'DESC');
        }
        if ($sort == 'created_at-asc') {
            return $query->orderBy('created_at','asc');
        }
        if ($sort == 'created_at-desc') {
            return $query->orderBy('created_at','desc');
        }
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeType($query, $type)
    {
        if ($type == null || $type == 'null' || !$type || $type=''){
            return $query;
        }

        return $query->where('type',$type);
    }
}
