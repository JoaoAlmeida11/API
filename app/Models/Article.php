<?php

// como se fosse uma API de noticias
// titulo
// image
// autor
// corpo da noticia

// aprender laravel xD

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Article extends Model{
    protected $table = 'articles';
    protected $fillable = ['title', 'author', 'newsBody', 'image'];
    public $timestamps = false;
}
