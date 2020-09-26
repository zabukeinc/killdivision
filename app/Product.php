<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function setSlugAttribute($value){
        $this->attributes["slug"] = Str::slug($value);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function image(){
        return $this->hasMany(Image::class);
    }
}
