<?php

namespace App\Http\View;

use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $carts_item = $this->getCarts();

        $carts_subtotal = collect($carts_item)->sum(function($q) {
            return $q['qty'] * $q['product_price']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });
        $carts_total_qty = collect($carts_item)->sum(function($q){
            return $q['qty'];
        });


        // Whatsapp logic
        $items = "";
        foreach($carts_item as $row){
            $items .=  " || " . $row['product_name'] . "[" . $row['product_size'] . "][x" . $row['qty'] . "] - Harga : " . $row['product_price'];
        }

        $string = "Saya ingin memesan : " . $items . " | Total Harga : " . $carts_subtotal;

        $sendWa = rawurlencode($string);
        $linkWA = "https://api.whatsapp.com/send?phone=6285155372241&text=" . $sendWa;

        $view->with('carts_item',$carts_item)->with('carts_subtotal', $carts_subtotal)->with('carts_total_qty', $carts_total_qty)->with('text_wa', $linkWA);
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('kd-carts'), true);
        $carts = $carts == '' ? [] : $carts;
        return $carts;
    }
}