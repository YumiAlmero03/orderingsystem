<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    //
    protected $relationMethods;
    protected $with = ['order'];
    protected $fillable = [
        'username', 'pass', 'status', 'table_id', 'orders', 'order_at'
    ];
    protected $hidden = [
        'pass'
    ];
    protected $casts = [
        'orders' => 'array'
    ];
    public function table()
    {
        return $this->belongsTo('App\Table');
    }
    public function request()
    {
        return $this->hasMany('App\Request');
    }
    public function order()
    {
        return $this->hasMany('App\Order');
    }
    public function changeStatus($status)
    {
        $table = Table::find($this->table_id);
        if($status === 'void'){
            $table->status = 'done';
        } else {
            $table->status = $status;
        }
        $table->save();
        $this->status = $status;
            //$this->table_id = NULL;

    	$this->save();
    	return $this->status;
    }

}
