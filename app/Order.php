<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['quantity'];
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
    
}
