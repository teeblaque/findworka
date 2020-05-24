<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attitude extends Model
{
    protected $fillable = [
        'name', 'url', 'gender', 'culture', 'born', 'died', 'father', 'mother', 'spouse'
    ];
}
