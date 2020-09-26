@extends('layouts.ecommerce')

@section('title')
    <title>KILLDIVISION - CO</title>
@endsection
@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: {{asset('ecommerce/img/bg-img/breadcumb.jpg')}};">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>SHOP </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                @foreach($categories as $category)
                                <li data-target="#{{$category->name}}">
                                        <a href="{{url('/category/' . $category->slug)}}">{{$category->name}}</a>
                                        <ul class="sub-menu  show" id="{{$category->name}}">
                                        @forelse($category->child as $child)
                                            <li><a href="{{url('/category/' . $child->slug)}}">{{$child->name}}</a></li>
                                            @empty
                                        @endforelse
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">CHAPTERS</p>
                            <div class="widget-desc">
                                <ul>
                                @forelse($chapter as $chapter)
                                    <li><a href="{{url('chapter/' . $chapter->slug)}}">{{$chapter->name}}</a></li>
                                @empty
                                @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{count($product)}}</span> products found</p>
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

                        @forelse($product as $row)

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
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <h3 class="text-center">Tidak ada produk</h3>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                        {{ $product->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
    @endsection