<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Home;
use App\Product;
use App\Category;
use App\Chapter;
use App\Image;

class FrontController extends Controller
{
    public function index()
    {
        $home = Home::orderBy("title", "desc")->get();

        return view("ecommerce.index", compact("home"));
    }

    public function search(Request $request){
        $this->validate($request, [
            'keyword' => 'regex:/^[a-zA-Z0-9\s]+$/',
        ]);

        $keyword = $request->keyword;
        $result = Product::where('name', 'like', '%'.$keyword.'%')->paginate();

        return view("ecommerce.product-result", compact("result"));
    }

    public function shop(){
        $product = Product::orderBy("created_at", "desc")->paginate(10);
        $chapters = Chapter::orderBy("created_at", "DESC")->get();
        return view("ecommerce.shop", compact("product", "chapters"));
    }

    public function about(){
        return view("ecommerce.about");
    }

    public function contact(){
        return view("ecommerce.contact");
    }

    public function showShop($slug){
        $product = Product::with(['category'])->where('slug', $slug)->first();
        $image = Image::with(["product"])->orderBy("created_at", "desc")->get();

        return view("ecommerce.show", compact("product", "image"));
    }

    public function categoryProduct($slug){
        $product = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('ecommerce.shop', compact('product'));
    }

    public function showChapter($slug){
        $data = Chapter::with(['product'])->where('slug', $slug)->first();
        return view("ecommerce.chapter", compact("data"));
    }
}
