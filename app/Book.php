<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','sort_id','content'];

    public function sort()
    {
        return $this->hasOne('App\Sort','id','sort_id');
    }
}
