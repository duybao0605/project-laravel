<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';
    protected $fillable =['idUser','idBlog','content','name','avatar'];

    public $timestamps = true;
}
