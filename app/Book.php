<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'url', 'isbn', 'numberOfPages', 'publisher', 'country', 'mediaType', 'released'
    ];

    public function author()
    {
        return $this->hasMany('App\Author');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function character()
    {
        return $this->hasMany('App\Character');
    }
}
