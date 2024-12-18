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
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 {{ $alumni->jurusan->slug }}">
                        <div class="single-item">
                            <div class="lecturers-item-wrapper">
                                <a href="#">
                                    <img class="img-fluid"
                                        src="{{ $alumni->photo ? asset('storage/' . $alumni->photo) : asset('images/default-image.jpg') }}"
                                        alt="team">
                                </a>
                                <div class="lecturers-content-wrapper">
                                    <h3><a href="#">{{ $alumni->nama_lengkap }}</a></h3>
                                    <span>{{ $alumni->jurusan->name }}</span>
                                    <p>{{ $alumni->status }}</p>
                                    <ul class="lecturers-social">
                                        @if ($alumni->instagram)
                                            <li><a href="{{ $alumni->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                        @endif
                                        @if ($alumni->linkedin)
                                            <li><a href="{{ $alumni->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                                        @endif
                                        @if ($alumni->facebook)
                                            <li><a href="{{ $alumni->facebook }}"><i class="fa fa-facebook"></i></a></li>
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
