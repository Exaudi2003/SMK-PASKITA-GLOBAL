@extends('layouts.backend.app')

@section('title', 'Tambah Ekstrakulikuler')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Tambah Ekstrakulikuler</h2>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Tambah Ekstrakulikuler</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('ekstrakulikuler.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- Nama Kategori --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_name">Nama Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="category_ekstrakulikuler_id"
                                                class="form-control @error('category_ekstrakulikuler_id') is-invalid @enderror">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_ekstrakulikuler_id')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Nama Ekstrakulikuler --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Ekstrakulikuler <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama Ekstrakulikuler">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Thumbnail --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Thumbnail</label>
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            {{-- <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                                placeholder="Deskripsi Ekstrakulikuler"></textarea> --}}
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                rows="4" placeholder="Deskripsi Ekstrakulikuler"></textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                    <a href="{{ route('ekstrakulikuler.index') }}" class="btn btn-warning">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote']
        })
        .catch(error => {
            console.error(error);
        });
</script>
