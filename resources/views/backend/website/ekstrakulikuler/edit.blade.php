@extends('layouts.backend.app')

@section('title')
    Edit Ekstrakulikuler
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
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2>Edit Ekstrakulikuler</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header header-bottom">
                            <h4>Edit Ekstrakulikuler</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('ekstrakulikuler.update', $ekstrakulikuler->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="category_ekstrakulikuler_id">Kategori Ekstrakulikuler</label>
                                            <span class="text-danger">*</span>
                                            <select name="category_ekstrakulikuler_id" id="category_ekstrakulikuler_id"
                                                class="form-control @error('category_ekstrakulikuler_id') is-invalid @enderror">
                                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $ekstrakulikuler->category_ekstrakulikuler_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
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

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Nama Ekstrakulikuler</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $ekstrakulikuler->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="description" rows="5"
                                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $ekstrakulikuler->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="image">Thumbnail</label>
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            <span class="text-danger" style="font-size: 10px">
                                                Kosongkan jika tidak ingin mengubah gambar.
                                            </span>
                                            @if ($ekstrakulikuler->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $ekstrakulikuler->image) }}"
                                                        alt="Thumbnail" style="width: 100px; height: auto;">
                                                </div>
                                            @endif
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('ekstrakulikuler.index') }}" class="btn btn-warning">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
