<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'article_id'
    ];

    public function article()
    {
    	return $this->belongsTo('App\Article');
    }
    //一則留言只屬於一篇文章
}
