<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $carts = json_decode($request->cookie('kd-carts'), true);
        $index = $request->product_id . $request->product_size;
        if ($carts && array_key_exists($index, $carts)) {
                $carts[$index]['qty'] += $request->qty;
        } else {
            $product = Product::find($request->product_id);
            $carts[$index] = [
                'qty' => $request->qty,
                'product_size' => $request->product_size,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->thumbnail
            ];
        }

        $cookie = cookie('kd-carts', json_encode($carts), 2880);
        return redirect()->back()->with(['success' => 'Produk Ditambahkan ke Keranjang'])->cookie($cookie);
    }

    public function listCart(){
        $carts = json_decode(request()->cookie("kd-carts"), true);

        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price'];
        });

        return view("ecommerce.cart", compact("carts", "subtotal"));
    }

    public function removeCart(Request $request)
    {
        $index = $request->product_id . $request->product_size;
        $carts = json_decode(request()->cookie('kd-carts'), true);
        unset($carts[$index]);
        $cookie = cookie('kd-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }

}
