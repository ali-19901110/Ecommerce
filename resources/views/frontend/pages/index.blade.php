@extends('frontend.layouts.master')

@section('main')
{{-- @include('') --}}
{{-- @dd($Categories) --}}
@php

$Categories = App\Models\Category::all();
if (!isset($products)) {
$products = \App\Models\Product::all();
}
$subcategries = App\Models\SubCategory::all();
@endphp

{{-- @dd($subProducts ?? '') --}}
{{-- <section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap"
                    style="background-image: url(assets/imgs/slider/slider-1.png)">
                    <div class="slider-content">
                        <h1 class="display-2 mb-40">
                            Don’t miss amazing<br />
                            grocery deals
                        </h1>
                        <p class="mb-65">Sign up for the daily newsletter</p>
                        <form class="form-subcriber d-flex">
                            <input type="email" placeholder="Your emaill address" />
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
                <div class="single-hero-slider single-animation-wrap"
                    style="background-image: url(assets/imgs/slider/slider-2.png)">
                    <div class="slider-content">
                        <h1 class="display-2 mb-40">
                            Fresh Vegetables<br />
                            Big discount
                        </h1>
                        <p class="mb-65">Save up to 50% off on your first order</p>
                        <form class="form-subcriber d-flex">
                            <input type="email" placeholder="Your emaill address" />
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section> --}}
@include('frontend.layouts.body.landing')
<!--End hero slider-->
<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                id="carausel-10-columns-arrows"></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach ($Categories as $category )
                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="shop-grid-right.html"><img src="{{ asset('frontend/assets/imgs/shop/cat-13.png') }}"
                                alt="" /></a>
                    </figure>
                    <h6><a href="shop-grid-right.html">{{$category->name}}</a></h6>
                    <span>26 items</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--End category slider-->
{{-- <section class="banners mb-25">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ asset('frontend/assets/imgs/banner/banner-1.png') }}" alt="" />
                    <div class="banner-text">
                        <h4>
                            Everyday Fresh & <br />Clean with Our<br />
                            Products
                        </h4>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('frontend/assets/imgs/banner/banner-2.png') }}" alt="" />
                    <div class="banner-text">
                        <h4>
                            Make your Breakfast<br />
                            Healthy and Easy
                        </h4>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-md-none d-lg-flex">
                <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <img src="{{ asset('frontend/assets/imgs/banner/banner-3.png') }}" alt="" />
                    <div class="banner-text">
                        <h4>The best Organic <br />Products Online</h4>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--End banners-->




<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{route('products.front.index')}}" class="nav-link active">
                        All
                    </a>
                </li>
                @foreach ($subcategries as $subcategory)
                <li class="nav-item" role="presentation">
                    <a href="{{route('products.subcategory', $subcategory->id)}}" class="nav-link" role="tab"
                        aria-controls="tab-two" aria-selected="false">{{$subcategory->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($products as $product )
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img"
                                            src="{{ asset('frontend/assets/imgs/shop/product-1-1.jpg') }}" alt="" />
                                        <img class="hover-img"
                                            src="{{ asset('frontend/assets/imgs/shop/product-1-2.jpg') }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                            class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                            class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{$product->name}}</a>
                                </div>
                                <h2><a href="shop-product-right.html">{{$product->description}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a
                                            href="vendor-details-1.html">NestFood</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>${{$product->price}}</span>
                                        <span class="old-price">$32.8</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="{{route('frontend.add.to.cart', $product->id)}}"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!--end product card test-->

                </div>
                <!--End product-grid-4-->
            </div>

        </div>
        <!--End tab-content-->
    </div>
</section>
<!--Products Tabs-->

@push('scripts')
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: @json(session('success')),
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true
    });
</script>
@endpush
@endsection