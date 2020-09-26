@extends('layouts.ecommerce')

@section('title')
    <title>KILLDIVISION - CO</title>
@endsection
@section('content')
    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{count($result)}}</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <!-- <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">

                        @forelse($result as $row)

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="{{ asset('storage/products/' . $row->thumbnail) }}" alt="{{ $row->name }}">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="{{ asset('storage/products/' . $row->thumbnail) }}" alt="{{ $row->name }}" alt="">

                                        <!-- Product Badge -->
                                        <!-- <div class="product-badge offer-badge">
                                            <span>-30%</span>
                                        </div> -->
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <a href="{{url('product/' . $row->slug)}}">
                                            <h6>{{$row->name}}</h6>
                                        </a>
                                        <p class="product-price"> @currency($row->price)</p>

                                        <!-- <form action="{{ route('front.cart') }}" method="POST">
                                            @csrf
                                        <div class="hover-content">
                                            <input type="hidden" name="product_id" value="{{ $row->id }}" class="form-control">
                                            <div class="add-to-cart-btn">
                                                <button class="btn essence-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12 text-center" style="margin:0 auto;">
                                <h3>Produk tidak ditemukan</h3>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                        {{ $result->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection