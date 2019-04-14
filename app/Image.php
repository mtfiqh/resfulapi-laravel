<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
        'name','enable','file'
    ];

    public $timestamps = false;

    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
