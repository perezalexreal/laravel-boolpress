<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use SoftDeletes;
    protected $fillable = [
        "title",
        "content",
        "coverImg",
        "slug",
        "category_id",
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
