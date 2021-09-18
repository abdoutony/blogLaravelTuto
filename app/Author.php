<?php

namespace App;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name','email'
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
}
