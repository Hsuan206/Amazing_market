<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    
	protected $table = "carousels";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'hint', 'img_url'
    ];
}
