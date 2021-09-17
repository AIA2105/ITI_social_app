<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
	
    public function comment_post()
    {
        return $this->belongsTo('App\Post');
    }
	
	public function comment_user()
    {
        return $this->belongsTo('App\User');
    }
}
