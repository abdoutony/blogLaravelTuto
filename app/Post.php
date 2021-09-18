<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Author;
class Post extends Model
{ 
    use SoftDeletes; 
    protected $fillable =[
        'title','content','postimage','author_id'
    ];

  public function author(){
      return $this->belongsTo(Author::class);
  }  
 

}
