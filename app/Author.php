<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
       'book_id', 'author'
    ];

    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
