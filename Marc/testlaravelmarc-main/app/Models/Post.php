<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "description",
        "content",
        "category_id",
        "image",
        "status"
    ];

    public function categori(){
        return $this->belongsTo(Category::class);
    }

}
