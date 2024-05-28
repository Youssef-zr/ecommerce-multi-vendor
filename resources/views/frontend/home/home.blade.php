@extends('frontend.layouts.master')

@section('title')
    - Home
@endsection

@section('content')

    <!-- BANNER PART 2 START -->
    @include('frontend.home.sections.banner-slider')
    <!-- BANNER PART 2 END -->


    @if ($flashSale?->end_date != null)
        <!-- FLASH SALE START -->
        @include('frontend.home.sections.flash-sale')
        <!-- FLASH SALE END -->
    @endif


    <!-- MONTHLY TOP PRODUCT START -->
    <!-- @include('frontend.home.sections.top-category-product') -->
    <!-- MONTHLY TOP PRODUCT END -->


    <!-- BRAND SLIDER START -->
    <!-- @include('frontend.home.sections.brand-slider') -->
    <!-- BRAND SLIDER END -->


    <!-- SINGLE BANNER START -->
    <!-- @include('frontend.home.sections.single-banner') -->
    <!-- SINGLE BANNER END -->


    <!-- HOT DEALS START -->
    <!-- @include('frontend.home.sections.hot-deals') -->
    <!-- HOT DEALS END -->


    <!-- ELECTRONIC PART START -->
    <!-- @include('frontend.home.sections.category-product-slider1') -->
    <!-- NIC PART END -->


    <!-- NIC PART START -->
    <!-- @include('frontend.home.sections.category-product-slider2') -->
    <!-- NIC PART END -->


    <!-- ANNER  START -->
    <!-- @include('frontend.home.sections.large-banner') -->
    <!-- ANNER  END -->


    <!-- BEST ITEM START -->
    <!-- @include('frontend.home.sections.weekly-best-item') -->
    <!-- BEST ITEM END -->


    <!-- RVICES START -->
    <!-- @include('frontend.home.sections.services') -->
    <!-- HOME SERVICES END -->


    <!-- HOME BLOGS START -->
    <!-- @include('frontend.home.sections.blog') -->
    <!-- HOME BLOGS END -->
@endsection
