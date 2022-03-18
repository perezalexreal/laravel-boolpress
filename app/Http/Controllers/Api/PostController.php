<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use SlugGenerator;
    public function index(){
        $posts = Post::all();

        // return response()->json([
        //     "response"=> "ok",
        //     "data"=> now(),
        //     "data"=> $post
        // ]);
        return response()->json($posts);
    }

    public function store(Request $request){
        $data = $request->validate([
            "title"=> "required | min:5",
            "content"=> "required | min:25",
            "category_id"=> "nullable ",
            "tags"=> "nullable"
        ]);


        $newPost = new Post();

        $newPost->fill($data);
        $newPost->user_id = 3;
        $newPost->slug = $this->generateUniqueSlug($data["title"]);
        $newPost->save();

        // // return $request->all();
        // return $request->all();
        // if(key_exists("tags", $data)){
        //     $newPost->tags()->attach($data);
        // }

        return response()->json($newPost);
    }
}
