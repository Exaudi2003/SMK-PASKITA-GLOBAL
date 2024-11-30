@extends('layouts.backend.app')

@section('title', 'Kategori Ekstrakurikuler')

@section('content')
    {{-- Content Wrapper --}}
    <div class="content-wrapper container-xxl p-0">
        {{-- Page Header --}}
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title">Ekstrakurikuler</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <section>
                        <div class="row">
                            @if ($ekstrakulikulers->count() > 0)
                                <div class="col-12">
                                    <div class="card">
                                        {{-- Card Header --}}
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4 class="card-title">Daftar Ekstrakurikuler</h4>
                                            <a href="{{ route('ekstrakulikuler.create') }}" class="btn btn-primary">
                                                Tambah Ekstrakulikuler
                                            </a>
                                        </div>

                                        {{-- Data Table --}}
                                        <div class="card-datatable">
                                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>#</th>
                                                        <th>Nama Ekstrakulikuler</th>
                                                        <th>Kategori</th>
                                                        <th>Thumbnail</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ekstrakulikulers as $key => $ekstrakulikuler)
                                                        <tr class="text-center">
                                                            <td>{{ $loop->iteration }}</td>

                                                            <td>{{ $ekstrakulikuler->name }}</td>
                                                            <td>{{ $ekstrakulikuler->category->category_name ?? '-' }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $ekstrakulikuler->image) }}"
                                                                    alt="Thumbnail" class="img-fluid rounded"
                                                                    style="max-width: 50px; max-height: 50px;">
                                                            </td>
                                                            <td>{{ $ekstrakulikuler->description ?? '-' }}</td>
                                                            <td>
                                                                <a href="{{ route('ekstrakulikuler.show', $ekstrakulikuler->id) }}" class="btn btn-info btn-sm">
                                                                    Detail
                                                                </a>
                                                                <a href="{{ route('ekstrakulikuler.edit', $ekstrakulikuler->id) }}" class="btn btn-success btn-sm">
                                                                    Edit
                                                                </a>
                                                                <form action="{{ route('ekstrakulikuler.destroy', $ekstrakulikuler->id) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $ekstrakulikuler->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $ekstrakulikuler->id }})">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- No Categories Found --}}
                                <div class="text-center">
                                    <h3 class="text-muted">Ekstrakurikuler Masih Kosong!</h3>
                                    <a href="{{ route('ekstrakulikuler.create') }}" class="btn btn-primary mt-3">
                                        Tambah Ekstrakurikuler
                                    </a>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            reverseButtons: true,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-secondary"
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
