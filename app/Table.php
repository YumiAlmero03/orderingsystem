<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //
    protected $fillable = [
        'status', 'place'
    ];
    protected $relationMethods;
    public function transaction()
    {
        return $this->hasOne('App\Transaction')->latest('created_at');
    }
    public function scopeAvailable($query)
    {
    	return $query->where('status', 'done')->first();
    }
}
