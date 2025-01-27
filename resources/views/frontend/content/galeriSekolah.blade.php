@extends('layouts.Frontend.app')

@section('title')
    Profile Alumni
@endsection

@section('content')
@section('about')
    <div class="inner-page-banner-area" style="background-image: url('img/banner/5.jpg');">
        <div class="container">
            <div class="pagination-area">
                <h1>Galeri SMK Paskita Global</h1>
                <ul>
                    <li>
                        <a href="{{ route('beranda') }}">Home</a> -
                    </li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="gallery-area1">
        <div class="container">
            <div class="row gallery-wrapper">
                @forelse ($galeriSekolah as $galeri)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="gallery-box">
                            <img src="{{ asset('storage/' . $galeri->image_path) }}" class="img-responsive" alt="gallery"
                                style="height: 200px; object-fit: cover;">
                            <div class="gallery-content">
                                <a href="{{ asset('storage/' . $galeri->image_path) }}" class="zoom" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="error-page-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="error-bottom">
                                        <h2>Sorry!!! Data yang anda cari Belum ada</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@endsection
