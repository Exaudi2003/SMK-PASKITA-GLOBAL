@extends('layouts.backend.app')

@section('title', 'Kategori Ekstrakurikuler')

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title">Kategori Ekstrakurikuler</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <section>
                        <div class="row">
                            @if ($categories->count() > 0)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4 class="card-title">Daftar Kategori Ekstrakurikuler</h4>
                                            <a href="{{ route('category-ekstrakulikuler.create') }}"
                                                class="btn btn-primary">
                                                Tambah Kategori
                                            </a>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Kategori</th>
                                                        <th>Thumbnail</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($categories as $key => $category)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $category->category_name }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                                    alt="Thumbnail" class="img-fluid rounded"
                                                                    style="max-width: 50px; max-height: 50px;">
                                                            </td>
                                                            <td>{{ $category->description ?? '-' }}</td>
                                                            <td>
                                                                <a href="{{ route('category-ekstrakulikuler.edit', $category->id) }}"
                                                                    class="btn btn-success btn-sm">
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('category-ekstrakulikuler.destroy', $category->id) }}"
                                                                    method="POST" style="display:inline-block;"
                                                                    id="delete-form-{{ $category->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        onclick="confirmDelete({{ $category->id }})">
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
                                <div class="text-center">
                                    <h3 class="text-muted">Kategori Masih Kosong!</h3>
                                    <a href="{{ route('category-ekstrakulikuler.create') }}" class="btn btn-primary mt-3">
                                        Tambah Kategori
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
