<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   public function posts(){
    return $this->belongsTo("App\Models\Post");
   }
}
