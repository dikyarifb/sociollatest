<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['tags'] = Tag::all();
        $data['posts'] = [];
        if($request->has('tags'))
        {
            $tag = $request->tags;
            $data['featured_post'] = Post::whereHas('tags', function($q) use ($tag){
                $q->where('slug', $tag);
            })->where('featured',1)->first();
            $data['posts'] = Post::whereHas('tags', function($q) use ($tag){
                $q->where('slug', $tag);
            })->where('featured',0)->orderBy('id', 'DESC')->get();
        }
        else
        {
            $data['featured_post'] = Post::where('featured',1)->first();
            $data['posts'] = Post::where('featured',0)->orderBy('id', 'DESC')->get();
            
        }
        return view('home', $data);
            
    }
    public function store(Request $request)
    {
        // data does not need to be validated again
        $post = new Post;

        $post->title = $request->title;

        $post->author = $request->author;

        $post->content = $request->content;

        if($request->has('featured'))
        {
            $post->featured = $request->featured;
        }
        else
        {
            $post->featured = 0;
        }
        
        if($post->save())
        {
            if($request->has('tags'))
            {
                $tags = array();

                $tags = $request->tags;

                foreach ($tags as $tag) 
                {

                    $post->tags()->attach($tag);

                }
            }
            if($request->has('featured'))
            {
                $lastFeaturedPost = Post::where('id', '<>', $post->id)->where('featured',1)->first();
                if($lastFeaturedPost)
                {
                    $lastFeaturedPost->featured = 0;
                    $lastFeaturedPost->save();
                }
                    
            }
            return redirect('/')->with([
                    'message'=> 'Success made a post',
                    'status' => 'success',
                    'title' => 'Good Job!'
                ]);            
        }
    }
    public function getcontent(Request $request)
    {
        if( !$request->ajax() ){  abort(404); }

        $post = Post::find($request->id);

        return response()->json($post);

    }
}
