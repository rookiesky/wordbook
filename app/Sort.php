<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    public $table = 'sort';

    protected $fillable = ['name','order'];

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function booksPaginate($limit = 20)
    {
        return $this->books()->orderBy('created_at','desc')->paginate($limit);
    }
}
