@extends('layouts.Frontend.app')

@section('title')
    Detail Ekstrakulikuler - {{ $ekstrakulikuler->name }}
@endsection

@section('content')
@section('about')
    <!-- Inner Page Banner Area Start Here -->
    <div class="inner-page-banner-area" style="background-image: url('img/banner/5.jpg');">
        <div class="container">
            <div class="pagination-area">
                <h1>  Detail Ekstrakulikuler - {{ $ekstrakulikuler->name }}</h1>
                <ul>
                    <li>
                        <a href="{{ route('beranda') }}">Home</a> -
                    </li>
                    <li>Details</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="news-details-page-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                    <div class="row news-details-page-inner">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="news-img-holder">
                                <img src="{{ asset('storage/' . $ekstrakulikuler->image) }}" class="img-responsive" alt="{{ $ekstrakulikuler->name }}">
                                <ul class="news-date1">
                                    <li>27 Dec</li>
                                    <li>2016</li>
                                </ul>
                            </div>
                            <h2 class="title-default-left-bold-lowhight">
                                <a href="#">{{ $ekstrakulikuler->name }}</a>
                            </h2>
                            <ul class="title-bar-high news-comments">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span>By</span> Admin
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
        </div>
    </div>
@endsection
@endsection
