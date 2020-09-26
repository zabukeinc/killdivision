<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Image;
use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    public function index(){
        $product = Product::with(["category","chapter","image"])->orderBy("created_at", "DESC");

        if(request()->q != ""){
            $product = $product->where("name", "LIKE", "%" . request()->q . "%");
        }

        $product = $product->paginate(10);

        return view("products.index", compact("product"));
    }

    public function create(){
        $category = Category::orderBy("name", "DESC")->get();

        return view("products.create", compact("category"));
    }

    public function store(Request $request){
        // $this->validate($request, [
        //     'name' => 'required|string|max:100',
        //     'description' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'chapter_id' => 'nullable|exists:chapters,id',
        //     'price' => 'required|integer',
        //     'quantity' => 'required|integer',
        //     "image" => "required|image|mimes:png,jpeg,jpg"
        // ]);
        if($request->hasFile("image")){
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'chapter_id' => $request->chapter_id,
                'description' => $request->description,
                'price' => $request->price,
                "quantity" => $request->quantity,
                "thumbnail" => $this->thumbnail($request->image[0], $request->name)
            ]);
            foreach($request->file('image') as $file){
                $name = time() . '-' . $file->getClientOriginalName();
                $name = str_replace(" ", "-",$name);
                $file->storeAs('public/products', $name);
                $product->image()->create(['filename' => $name]);
            }
        }

        return redirect(route("product.index"))->with(["success" => "Produk berhasil ditambah"]);
    }

    public function thumbnail($image, $name){
        $file = $image->getClientOriginalExtension();
        $thumbnail = 'thumbnail-'.time() . Str::slug($name).'-'.$file;
        $image->storeAs('public/products', $thumbnail);

        return $thumbnail;
    }

    public function edit($id){
        $product = Product::find($id);
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'chapter_id' => 'required|exists:chapters,id',
            'price' => 'required|integer',
            // 'image' => 'nullable|image|mimes:png,jpeg,jpg'
        ]);

        $product = Product::find($id);
        // $filename = $product->image;

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/products', $filename);
        //     File::delete(storage_path('app/public/products/' . $product->image));
        // }

        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "category_id" => $request->category_id,
            "price" => $request->price,
            // "image" => $filename
        ]);

        return redirect(route("product.index"))->with(["success" => "Data produk berhasil diupdate"]);
    }

    public function destroy($id){
        $product = Product::find($id);
        File::delete(storage_path('app/public/products/' . $product->image));
        $product->image()->delete();
        $product->delete();

        return redirect(route("product.index"))->with(["success" => "Produk berhasil dihapus"]);
    }
}
