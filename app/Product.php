<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //table config
    protected $fillable = [
        'name','descriiption','enable',
    ];

    public $timestamps = false;

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function images(){
        return $this->belongsToMany('App\Image');
    }
}
