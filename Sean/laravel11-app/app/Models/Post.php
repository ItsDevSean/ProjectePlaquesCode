<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'categories_id', 'desciption', 'posted', 'image'];

    public function categories() {
        return $this->belongsToMany(Categories::class);
    }
}
