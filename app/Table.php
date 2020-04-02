<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //
    protected $with = ['transaction'];
    protected $fillable = [
        'status', 'place', 'id'
    ];
    protected $relationMethods;
    public function transaction()
    {
        return $this->hasOne('App\Transaction')->latest('created_at');
    }
    public function scopeAvailable($query)
    {
    	return $query->where('status', 'vacant')->first();
    }
}
