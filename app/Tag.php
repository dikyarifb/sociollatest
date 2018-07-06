<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Tag extends Model
{
    //
    protected $table = 'tags';
    
    use Sluggable;

    public function sluggable(){
    	return [
    		'slug' => [
    			'source' => 'title'
    		]
    	];
    }

    public function post()
    {
        return $this->belongsToMany('App\Post', 'post_tags');
    }
}
