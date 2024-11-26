@extends('layouts.backend.app')

@section('title')
    Edit Kategori Ekstrakulikuler
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
                        <h2>Kategori Ekstrakulikuler</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header header-bottom">
                            <h4>Edit Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category-ekstrakulikuler.update', $categoryEkstrakulikuler->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="category_name">Nama Kategori</label>
                                            <span class="text-danger">*</span>
                                            <input type="text"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                name="category_name" value="{{ $categoryEkstrakulikuler->category_name }}">
                                            @error('category_name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="image">Thumbnail</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image">
                                            <span class="text-danger" style="font-size: 10px">
                                                Kosongkan jika tidak ingin mengubah.
                                            </span>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                                                rows="5">{{ $categoryEkstrakulikuler->description }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('category-ekstrakulikuler.index') }}" class="btn btn-warning">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
