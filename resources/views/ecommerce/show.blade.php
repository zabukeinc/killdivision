@extends('layouts.ecommerce')

@section('title')
    <title>Jual {{ $product->name }}</title>
@endsection

@section('content')
<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <!-- <div class="single_product_thumb clearfix">
    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
    </div> -->
    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
        @forelse($image as $img)
            <img src="{{ asset('storage/products/' . $img->filename) }}" alt="image">
        @empty
        @endforelse
        </div>
    </div>

    <!-- Single Product Description -->


    <div class="single_product_desc clearfix">
        <a href="{{url('/category/' . $product->category->slug)}}"><span>{{$product->category->name}}</span></a>
            <h2>{{$product->name}}</h2>
        <p class="product-price">@currency($product->price)</p>
        <p class="product-desc">{!!$product->description !!}</p>

        <!-- Form -->
        <form action="{{ route('front.cart') }}" method="POST">
            <!-- Select Box -->
            <div class="select-box d-flex mt-50 mb-30">
                <select name="product_size" id="product_size" class="mr-5">
                    <option value="XL">Size: XL</option>
                    <option value="L">Size: L</option>
                    <option value="M">Size: M</option>
                    <option value="S">Size: S</option>
                </select>
                    <hp style="margin-top:15px;margin-right:5px;">Qty</hp>
                    <input type="number" min="1" class="form-control" name="qty" id="qty" default="1" style="width:20%;text-align:center;" value="1">
            </div>
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
            <div class="cart-fav-box d-flex align-items-center">
                <!-- Cart -->
                <button class="btn essence-btn">Add to cart</button>
            </div>
            </form>
    </div>
</section>


<script>
function increaseQty() {
    var value = parseInt(document.getElementById('qty').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('qty').value = value;
}

function decreaseQty(){
    var value = parseInt(document.getElementById('qty').value, 10);
    value = isNaN(value) ? 0 : value;
    value <= 1 ? value = 1 : '';
    value--;
    document.getElementById('qty').value = value;
}
</script>
@endsection