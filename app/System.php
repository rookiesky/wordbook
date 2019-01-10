<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = ['title','keyword','description','statistical','forever','notice'];
}
