<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
