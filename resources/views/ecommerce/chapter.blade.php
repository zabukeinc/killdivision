@extends('layouts.ecommerce')

@section('title')
    <title>KILLDIVISION - CO</title>
@endsection

@section('content')
<div class="breadcumb_area breadcumb-style-two bg-img" style="background-image: url(img/bg-img/breadcumb2.jpg);" style="position:relative;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
            <img src="{{asset('storage/chapters/' . $data->image)}}" alt="Image of {{$data->name}}">
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:160px;">
            <div class="row justify-content-center" >
                <div class="col-12 col-md-8">
                    <div class="regular-page-content-wrapper section-padding-80">
                    <div class="page-title text-center">
                        <h2 style="color:#000;" >{{$data->name}}</h2>
                    </div>
                        <div class="regular-page-text">
                            <p>Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin. Praesent at tempus lectus, eleifend blandit felis. Fusce augue arcu, consequat a nisl aliquet, consectetur elementum turpis. Donec iaculis lobortis nisl, et viverra risus imperdiet eu. Etiam mollis posuere elit non sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis arcu a magna sodales venenatis. Integer non diam sit amet magna luctus mollis ac eu nisi. In accumsan tellus ut dapibus blandit.</p>

                            <blockquote>
                                <h6><i class="fa fa-quote-left" aria-hidden="true"></i> Quisque sagittis non ex eget vestibulum. Sed nec ultrices dui. Cras et sagittis erat. Maecenas pulvinar, turpis in dictum tincidunt, dolor nibh lacinia lacus.</h6>
                                <span>Liam Neeson</span>
                            </blockquote>

                            <p>Praesent ac magna sed massa euismod congue vitae vitae risus. Nulla lorem augue, mollis non est et, eleifend elementum ante. Nunc id pharetra magna. Praesent vel orci ornare, blandit mi sed, aliquet nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<section class="single_product_details_area d-flex align-items-center">
@forelse($data->product as $product)
<!-- Single Product -->
<div class="col-12 col-sm-6 col-lg-4">
    <div class="single-product-wrapper">
        <!-- Product Image -->
        <div class="product-img">
            <img src="{{ asset('storage/products/' . $product->thumbnail) }}" alt="{{ $product->name }}">
            <!-- Hover Thumb -->
            <img class="hover-img" src="{{ asset('storage/products/' . $product->thumbnail) }}" alt="{{ $product->name }}" alt="">
        </div>

        <!-- Product Description -->
        <div class="product-description">
            <a href="{{url('product/' . $product->slug)}}">
                <h6>{{$product->name}}</h6>
            </a>
            <p class="product-price"> @currency($product->price)</p>
        </div>
    </div>
</div>
@empty
@endforelse
</section>

@endsection