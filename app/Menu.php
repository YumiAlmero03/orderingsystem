<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'name', 'desc', 'price', 'pic', 'category_id', 'feat', 'active'
    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function scopeRandomName($query)
    {
    	$users = $query->inRandomOrder()->first();
    	return $users->name;
    }
    public function order()
    {
        return $this->hasMany('App\Order');
    }
    public function orderByDate($start, $end)
    {
        //dd($date);
        return $this->hasMany('App\Order')->whereBetween('updated_at', [$start, $end]);
    }
    public function getQuantity($id, $cat)
    {
        return $this->order()->where(['transaction_id' => $id, 'category_id' => $cat])->orderBy('id', 'desc')->first();
    }
}
