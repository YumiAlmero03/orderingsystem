<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
    public function menu()
    {
        return $this->hasOne('App\Menu');
    }
}
