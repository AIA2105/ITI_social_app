<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';
	
    public function post_comment()
    {
        return $this->hasMany('App\Comment');
    }
	
	public function post_user()
    {
        return $this->belongsTo('App\User');
    }
}
