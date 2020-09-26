<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Image extends Model
{
    protected $table = 'image';
    protected $fillable = ["product_id", "filename"];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
