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


    // has relationship to many with posts
    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
