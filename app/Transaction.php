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
        if($status === 'void' || $status === 'done'){
            $table->status = 'vacant';            
        } else {
            if($table->status === 'manual'){
            } else {
                $table->status = $status;
            }
        }
            $table->save();
        if($table->status === 'manual'){
        } else {
            $this->status = $status;
        }
        
            $this->save();
    	return $this->status;
    }

}
