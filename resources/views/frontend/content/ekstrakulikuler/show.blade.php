@extends('layouts.Frontend.app')

@section('title')
    Detail Ekstrakulikuler - {{ $ekstrakulikuler->name }}
@endsection

@section('content')
@section('about')
    <!-- Inner Page Banner Area Start Here -->
    <div class="inner-page-banner-area" style="background-image: url('{{ asset('img/banner/5.jpg') }}');">
        <div class="container">
            <div class="pagination-area">
                <h1>Detail Ekstrakulikuler - {{ $ekstrakulikuler->name }}</h1>
                <ul>
                    <li>
                        <a href="{{ route('beranda') }}">Home</a> -
                    </li>
                    <li>Details</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- News Details Page Area Start Here -->
    <div class="news-details-page-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                    <div class="row news-details-page-inner">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="news-img-holder">
                                <img src="{{ asset('storage/' . $ekstrakulikuler->image) }}" class="img-responsive"
                                    alt="{{ $ekstrakulikuler->name }}">
                            </div>
                            <h2 class="title-default-left-bold-lowhight">
                                {{ $ekstrakulikuler->name }}
                            </h2>
                            <ul class="title-bar-high news-comments">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span>By</span> Admin
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        {{ $ekstrakulikuler->category->name }}
                                    </a>
                                </li>
                            </ul>
                            <p>
                                {!! $ekstrakulikuler->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gallery Section Start Here -->
            <div class="container">
                <div class="section-title-wrapper">
                    <h2 class="title-default-left-bold">Galeri {{ $ekstrakulikuler->name }}</h2>
                </div>
                <div id="inner-isotope">
                    <div class="row featuredContainer gallery-wrapper">
                        @foreach ($ekstrakulikuler->galeriEkstrakulikuler as $galeri)
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                <div class="gallery-box">
                                    <img src="{{ asset('storage/' . $galeri->path) }}" class="img-responsive"
                                        alt="gallery">
                                    <div class="gallery-content">
                                        <a href="{{ asset('storage/' . $galeri->path) }}" class="zoom">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
