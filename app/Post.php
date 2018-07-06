<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = [
        'title', 'author', 'content',
    ];

    use Sluggable;

    public function sluggable(){
    	return [
    		'slug' => [
    			'source' => 'title'
    		]
    	];
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tags');
    }

}
