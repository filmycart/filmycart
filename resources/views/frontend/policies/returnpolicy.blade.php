@extends('frontend.layouts.app')

@section('meta_title'){{ optional($page)->meta_title ?? translate('Return Policy') }}@stop

@section('meta_description'){{ optional($page)->meta_description }}@stop

@section('meta_keywords'){{ optional($page)->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ optional($page)->meta_title ?? translate('Return Policy') }}">
    <meta itemprop="description" content="{{ optional($page)->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset(optional($page)->meta_image) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="website">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ optional($page)->meta_title ?? translate('Return Policy') }}">
    <meta name="twitter:description" content="{{ optional($page)->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(optional($page)->meta_image) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ optional($page)->meta_title ?? translate('Return Policy') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('returnpolicy') }}" />
    <meta property="og:image" content="{{ uploaded_asset(optional($page)->meta_image) }}" />
    <meta property="og:description" content="{{ optional($page)->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
<div class="aiz-main-wrapper d-flex flex-column">
    <div class="home-banner-area mb-4 pt-3">
        <section class="pt-4 mb-4">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-left">
                        <h1 class="fw-600 h4">{{ $page ? $page->getTranslation('title') : translate('Return Policy') }}</h1>
                    </div>
                    <div class="col-lg-6">
                        <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item has-transition opacity-50 hov-opacity-100">
                                <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                            </li>
                            <li class="text-dark fw-600 breadcrumb-item">
                                "{{ translate('Return Policy') }}"
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-4">
            <div class="container">
                <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left">
                    @if ($page && trim(strip_tags((string) $page->getTranslation('content'))) !== '')
                        {!! $page->getTranslation('content') !!}
                    @else
                        <p class="mb-2">{{ translate('Return policy information is being updated. Please contact customer support before placing an order if you need clarification about returns or refunds.') }}</p>
                    @endif
                </div>
            </div>
        </section>
    </div>    
</div>        
@endsection
