<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'book_id', 'character'
    ];

    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
