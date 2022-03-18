<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Support\Str;

trait SlugGenerator {
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

?>