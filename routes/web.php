<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();



Route::group(["prefix" => "admin", "middleware" => "auth"], function(){
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::resource("/home", "HomeController");
    Route::resource("/chapter", "ChapterController");
    Route::resource("/category", "CategoryController")->except(["create", "show"]);
    Route::resource("/product", "ProductController");
});


Route::get("/", "Ecommerce\FrontController@index")->name("front.index");
Route::post("search", "Ecommerce\FrontController@search")->name("front.search");
Route::get("/shop", "Ecommerce\FrontController@shop")->name("front.shop");
Route::get("/category/{slug}", "Ecommerce\FrontController@categoryProduct")->name("front.category");
Route::get("/product/{slug}", "Ecommerce\FrontController@showShop")->name("front.show_product");
Route::get("/chapter/{slug}", "Ecommerce\FrontController@showChapter")->name("front.show_chapter");

Route::post("cart", "Ecommerce\CartController@addToCart")->name("front.cart");
Route::post("cart/remove", "Ecommerce\CartController@removeCart")->name("front.remove_cart");
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('front.list_cart');


Route::get("/about", "Ecommerce\FrontController@about")->name("front.about");
Route::get("/contact", "Ecommerce\FrontController@contact")->name("front.contact");