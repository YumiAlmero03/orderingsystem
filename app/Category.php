<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name'
    ];
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
    public function scopeRandomName($query)
    {
    	$users = $query->inRandomOrder()->first();
    	return $users->name;

    }
}
