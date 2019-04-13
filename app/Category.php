<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name','enable',
    ];

    public $timestamps = false;

    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
