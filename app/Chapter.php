<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';
    protected $fillable = ["name", "description","slug", "image"];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
