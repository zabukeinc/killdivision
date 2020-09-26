
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    @yield("title")

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('ecommerce/css/core-style.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/style.css')}}">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="{{route('front.index')}}">
                    <img height="75" width="75" src="{{asset('assets/img/kdlogo.png')}}" alt="">
                </a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        @include("layouts.ecommerce.module.menu")
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="{{ route('front.search') }}" method="post">
                    @csrf
                        <input type="search" name="keyword" id="headerSearch" placeholder="Type for search">
                        <button><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <!-- <div class="favourite-area">
                    <a href="#"><img src="{{asset('ecommerce/img/core-img/heart.svg')}}" alt=""></a>
                </div> -->
                <!-- User Login Info -->
                <!-- <div class="user-login-info">
                    <a href="#"><img src="{{asset('ecommerce/img/core-img/user.svg')}}" alt=""></a>
                </div> -->
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="{{asset('ecommerce/img/core-img/bag.svg')}}" alt=""> <span>{{ $carts_total_qty ?? 0 }}</span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{asset('ecommerce/img/core-img/logo2.png')}}" alt=""> <span>{{ $carts_total_qty ?? 0 }}</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
            @forelse($carts_item as $row)
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <div class="product-image">
                        <img src="{{asset('storage/products/' . $row['product_image'])}}" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                        <form action="{{ route('front.remove_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $row['product_id'] }}" class="form-control">
                        <input type="hidden" name="product_size" value="{{ $row['product_size'] }}" class="form-control">
                          <button class="product-remove btn">
                          <i class="fa fa-close" aria-hidden="true" style="color:#000"> </i>
                          </button>
                        </form>
                            <h6>{{$row['product_name']}}
                            <span>({{$row['qty']}}x)</span>
                            </h6>
                            <p class="size">Size: {{$row['product_size']}}</p>
                            <p class="price">@currency($row['product_price'])</p>

                        </div>
                    </div>
                </div>
                @empty
                @endforelse
                </div>
                @if(count($carts_item) != 0)
                <div class="cart-amount-summary">
                    <h2>Summary</h2>
                    <ul class="summary-table">
                        <li><span>total:</span> <span>@currency($carts_subtotal)</span></li>
                    </ul>
                    <div class="checkout-btn mt-100">
                        <a href="{{$text_wa}}" class="btn essence-btn">check out</a>
                    </div>
                </div>
                @else
                <h3 class="text-center">Cart is empty</h3>
                @endif

            <!-- Cart Summary -->


            <!-- https://api.whatsapp.com/send?phone=6285155372241&text=How%20are%20you%20%3f&source=&data=&app_absent= -->
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->
    @yield("content")
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="{{url('/')}}">
                                <img height="150" width="150" src="{{asset('assets/img/kdlogo_white.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('ecommerce/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('ecommerce/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('ecommerce/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('ecommerce/js/plugins.js')}}"></script>
    <!-- Classy Nav js -->
    <script src="{{asset('ecommerce/js/classy-nav.min.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('ecommerce/js/active.js')}}"></script>

</body>

</html>