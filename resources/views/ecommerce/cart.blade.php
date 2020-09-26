@extends('layouts.ecommerce')

@section('title')
    <title>CART - KILLDIVISION</title>
@endsection
<div class="container">
    <div class="row" style="padding:50px;">
    <div class="col-12 col-md-12 col-lg-12 ml-lg-auto">
<div class="order-details-confirmation">

    <div class="cart-page-heading">
        <h5>Your Order</h5>
        <p>The Details</p>
    </div>

    <ul class="order-details-form mb-4">
        <li><span>Product</span> <span>Total</span></li>
        @forelse($carts as $row)
        <li>
            <span>{{$row['product_name']}} ({{$row['qty']}}x)</span>
            <span>@currency($row['product_price'])</span>
        </li>
        @empty
        <li>
            <h4>Cart is empty</h4>
        </li>
        <li><span>Total</span> <span>{{$carts['product_price'] * $carts['qty']}}</span></li>
        @endforelse
        <br><br>
        <li><span>Subtotal</span> <span>@currency($subtotal)</span></li>
    </ul>
    <a href="#" class="btn essence-btn">Place Order</a>
</div>
</div>
    </div>
</div>

@section('content')