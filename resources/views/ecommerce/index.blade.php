@extends('layouts.ecommerce')

@section('title')
    <title>KILLDIVISION - CO</title>
@endsection

@section('content')
@forelse($home as $row)
<img src="{{ asset('storage/home/' . $row->image) }}">
<section class="welcome_area">
        <div class="container text-center">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>{{$row->subtitle}}</h6>
                        <h2>{{$row->title}}</h2>
                        <a href="{{url('shop')}}" class="btn essence-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @empty
    @endforelse

@endsection