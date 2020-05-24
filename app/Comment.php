<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'book_id', 'comment', 'ipAddress'
    ];

    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
