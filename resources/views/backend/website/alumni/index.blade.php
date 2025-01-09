@extends('layouts.backend.app')

@section('title')
    Alumni
@endsection

@section('content')
    <!-- Bagian alert tetap sama -->

    <div class="content-wrapper container-xxl p-0">
        <!-- Header tetap sama -->
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
                                                        <th>Social Media</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alumnis as $key => $alumni)
                                                        <tr>
                                                            <td></td>
                                                            <td> {{ $key + 1 }} </td>
                                                            <td> {{ $alumni->nama_lengkap }} </td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $alumni->photo) }}"
                                                                    class="img-responsive"
                                                                    style="max-width: 100px; max-height: 100px">
                                                            </td>
                                                            <td> {{ $alumni->angkatan }} </td>
                                                            <td> {{ $alumni->jurusan->nama }} </td>
                                                            <td> {{ $alumni->nomor_hp }} </td>
                                                            <td>
                                                                <div class="d-flex gap-1">
                                                                    @if ($alumni->instagram)
                                                                        <a href="https://instagram.com/{{ $alumni->instagram }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-icon btn-instagram"
                                                                            data-toggle="tooltip" title="Instagram">
                                                                            <i class="fab fa-instagram"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if ($alumni->facebook)
                                                                        <a href="{{ $alumni->facebook }}" target="_blank"
                                                                            class="btn btn-sm btn-icon btn-facebook"
                                                                            data-toggle="tooltip" title="Facebook">
                                                                            <i class="fab fa-facebook-f"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if ($alumni->nomor_hp)
                                                                        <a href="https://wa.me/{{ str_replace(['-', ' '], '', $alumni->nomor_hp) }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-icon btn-success"
                                                                            data-toggle="tooltip" title="WhatsApp">
                                                                            <i class="fab fa-whatsapp"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
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
<!-- Font Awesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@push('css')
    <style>
        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-instagram {
            background: #E1306C;
            color: white;
        }

        .btn-instagram:hover {
            background: #c13584;
            color: white;
        }

        .btn-facebook {
            background: #4267B2;
            color: white;
        }

        .btn-facebook:hover {
            background: #385898;
            color: white;
        }

        .gap-1 {
            gap: 0.25rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
