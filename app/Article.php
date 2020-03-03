<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'content', 'img_url'
        /* 這些都是在migration資料庫裡面新增的table
           除了預設的id                   > $table->bigIncrements('id'); 
                    create_at, update_at > $table->timestamps();
           都設定為$fillable
        */
    ];
    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }
}
