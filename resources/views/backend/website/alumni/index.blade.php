@extends('layouts.backend.app')

@section('title')
    Alumni
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @endif
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top text-center">
                    <div class="col-12">
                        <h2>Data Alumini SMK Paskita Globall</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <section>
                        <div class="row">
                            @if ($alumnis->count() > 0)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">Daftar Alumni </h4>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-responsive table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Foto</th>
                                                        <th>Angkatan</th>
                                                        <th>Jurusan</th>
                                                        <th>Nomor HP</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alumnis as $key => $alumni)
                                                        <tr>
                                                            <td></td>
                                                            <td> {{ $key + 1 }} </td>
                                                            <td> {{ $alumni->nama_lengkap }} </td>
                                                            <td>
                                                                <img src="{{ asset('storage/images/berita/' . $alumni->photo) }}"
                                                                    class="img-responsive"
                                                                    style="max-width: 50px; max-height: 50px">

                                                            </td>
                                                            <td> {{ $alumni->angkatan }} </td>
                                                            <td> {{ $alumni->jurusan->nama }} </td>
                                                            <td> {{ $alumni->nomor_hp }} </td>
                                                            <td>
                                                                <a href=" {{ route('backend-alumni.show', $alumni->id) }} "
                                                                    class="btn btn-success btn-sm">Detail</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h3>Belum Ada Data Alumni</h3>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
