@extends('layouts.Frontend.app')

@section('title')
    Profile Alumni
@endsection

@section('content')
@section('about')
    <div class="lecturers-page2-area">
        <div class="container" id="inner-isotope">
            <!-- Filter Buttons -->
            <div class="row">
                <div class="col-12">
                    <div class="isotop-classes-tab isotop-btn-accent">
                        <!-- Menambahkan filter berdasarkan jurusan -->
                        <a href="{{ route('alumni.index') }}" data-filter="*"
                            class="{{ request()->get('jurusan_id') == '' ? 'current' : '' }}">All</a>
                        @foreach ($jurusanM as $jurusan)
                            <a href="{{ route('alumni.index', ['jurusan_id' => $jurusan->id]) }}"
                                data-filter=".{{ $jurusan->slug }}"
                                class="{{ request()->get('jurusan_id') == $jurusan->id ? 'current' : '' }}">
                                {{ $jurusan->nama }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Alumni List -->
            <div class="row featuredContainer">
                @foreach ($alumnis as $alumni)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 {{ $alumni->jurusan->slug }}">
                        <div class="single-item">
                            <div class="lecturers1-item-wrapper">
                                <div class="lecturers-img-wrapper">
                                    <a href="#">
                                        <img class="img-responsive" src="{{ $alumni->photo ? asset('storage/' . $alumni->photo) : asset('images/default-image.jpg') }}" alt="team">
                                    </a>
                                </div>
                                <div class="lecturers-content-wrapper">
                                    <h3 class="item-title">
                                        <a href="#">{{ $alumni->nama_lengkap }}</a>
                                    </h3>
                                    <span class="item-designation">{{ $alumni->jurusan->name }}</span>
                                    <ul class="lecturers-social">
                                        @if ($alumni->instagram)
                                            <li><a href="{{ $alumni->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                        @endif
                                        @if ($alumni->linkedin)
                                            <li><a href="{{ $alumni->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        @endif
                                        @if ($alumni->twitter)
                                            <li><a href="{{ $alumni->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        @endif
                                        @if ($alumni->facebook)
                                            <li><a href="{{ $alumni->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@endsection
