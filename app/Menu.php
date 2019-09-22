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
}
