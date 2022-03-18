<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "content",
        "slug",
        "category_id",
        "coverimg"
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
      }
    public function category() {
        return $this->belongsTo("App\Models\Category");
      }

    public function tags(){
      return $this->belongsToMany("App\Models\Tag");
    }    

}
