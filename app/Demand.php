<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    //
    protected $table = 'requests';
    protected $fillable = [
        'status', 'content','table_id','status'
    ];
    //use SoftDeletes;
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
