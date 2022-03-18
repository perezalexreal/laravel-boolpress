<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // se voglio vedere solo i miei
        $posts = Post::where("user_id",Auth::user()->id)->get(); // da chiedere;

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view("admin.posts.create", [
            "categories"=> $categories,
            "tags"=>$tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title"=> "required | min:5",
            "content"=> "required | min:25",
            "category_id"=> "nullable | exists:categories,id",
            "tags"=> "nullable| exists:tags,id"
        ]);

        
        $post = new Post();
        $post->fill($data);

        // $slug = Str::slug($post->title);
        // $exists = Post::where("slug", $slug)->first();
        // $counter= 1;
        // while($exists){
        //     $newSlug = $slug . "-" . $counter;
        //     $counter++;
        //     $exists = Post::where("slug", $newSlug)->first();
        //     if(!$exists){
        //         $slug = $newSlug;
        //     }
        // }
        

        $post->slug = $this->generateUniqueSlug($post->title);
        $post->user_id = Auth::user()->id;
        $post->save();

        // $post->tags()->attach($data["tags"]);
        if(key_exists("tags", $data)){

            $post->tags()->attach($data["tags"]);  // non riesce deselzionare tutti e tag e salvare
            
        }
       // carica tutto, nel caso di create meglio questo

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();

        
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();

        $tags = Tag::all();

        $post = Post::where("slug",$slug)->first();

        return view("admin.posts.edit", [
          "post" =>  $post,
           "categories"=>  $categories,
           "tags"=>  $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "title"=> "required | min:5",
            "content"=> "required | min:25",
            "category_id"=> "nullable | exists:categories,id",
            "tags"=> "nullable | exists:tags,id"
        ]);

        // dd($request->all()); cosi vedo i dati che vengono passati

        $post = Post::findOrFail($id);



        if($data["title"] !== $post->title){
            $data["slug"] =  $this->generateUniqueSlug($data["title"]);
        }


        // carica solo quello di cui
        // è stato inserito e non tocca
        // quelli che ci sono gia


        $post->update($data);


        if(key_exists("tags", $data)){

            $post->tags()->sync($data["tags"]); // non riesce deselzionare tutti e tag e salvare
            
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // $post->tafgs()->detach();

        $post->tags()->detach();

        $post->delete();

        // POost::destroy($id);
        return  redirect()->route("admin.posts.index");
    }


    public function generateUniqueSlug($postTitle){
        $slug = Str::slug($postTitle);
        $exists = Post::where("slug", $slug)->first();
        $counter= 1;
        while($exists){
            $newSlug = $slug . "-" . $counter;
            $counter++;
            $exists = Post::where("slug", $newSlug)->first();
            if(!$exists){
                $slug = $newSlug;
            }
        }
        return $slug;
    }
}
