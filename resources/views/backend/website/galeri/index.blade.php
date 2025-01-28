@extends('layouts.backend.app')

@section('title', 'Galeri Sekolah')



@section('content')
    <div class="content-wrapper container-xxl p-0">
        {{-- Gallery Section --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    {{-- Card Header --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Galeri Sekolah</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                            Tambah Galeri
                        </button>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <div class="row">
                            @forelse ($galeris as $item)
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm">
                                        @php
                                            $filePath = asset('storage/' . $item->image_path);
                                        @endphp

                                        @if (Str::endsWith($item->image_path, ['.mp4']))
                                            <video controls class="img-fluid" style="width: 100%; height: 200px;">
                                                <source src="{{ $filePath }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif (file_exists(public_path('storage/' . $item->image_path)))
                                            <img src="{{ $filePath }}" alt="Gallery Image" class="img-fluid rounded"
                                                style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center"
                                                style="height: 200px; background: #f8f9fa;">
                                                <p class="text-muted">Media tidak ditemukan</p>
                                            </div>
                                        @endif

                                        <div class="card-body text-center">
                                            <form action="{{ route('galeri-sekolah.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p class="text-muted">Belum ada galeri untuk ekstrakurikuler ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- Modal Tambah Galeri --}}
    <div class="modal fade" id="addGalleryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('galeri-sekolah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGalleryModalLabel">Tambah Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group mb-3">
                                    <label for="path" class="form-label fw-bold">Unggah Gambar/Video</label>
                                    <div class="upload-area border rounded p-3 text-center mb-3">
                                        <input type="file" name="image_path" id="image_path"
                                            class="form-control @error('image_path') is-invalid @enderror"
                                            accept="image/*,video/*" required style="display: none;">

                                        <label for="image_path" class="upload-label" style="cursor: pointer;">
                                            <i class="fas fa-cloud-upload-alt mb-2" style="font-size: 48px;"></i>
                                            <p class="mb-0">Klik atau seret file ke sini untuk mengunggah</p>
                                            <small class="text-muted">Format yang didukung: JPG, PNG, MP4</small>
                                        </label>

                                        @error('image_path')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Preview Container --}}
                                    <div class="preview-container mt-3 text-center d-none" id="previewContainer">
                                        <h6 class="mb-3">Preview:</h6>
                                        <img id="preview" src="#" alt="Preview"
                                            class="img-preview img-fluid rounded shadow-sm"
                                            style="max-height: 300px; object-fit: contain;">
                                        {{-- Preview untuk video --}}
                                        <video id="videoPreview" controls
                                            class="video-preview img-fluid rounded shadow-sm d-none"
                                            style="max-height: 300px; width: 100%; object-fit: contain;">
                                            <source src="" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputFile = document.getElementById('image_path');
        const previewContainer = document.getElementById('previewContainer');
        const imgPreview = document.getElementById('preview');
        const videoPreview = document.getElementById('videoPreview');
        const uploadLabel = document.querySelector('.upload-label');

        inputFile.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                previewContainer.classList.remove('d-none');
                uploadLabel.textContent = file.name;

                if (file.type.startsWith('image/')) {
                    imgPreview.classList.remove('d-none');
                    videoPreview.classList.add('d-none');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    imgPreview.classList.add('d-none');
                    videoPreview.classList.remove('d-none');
                    videoPreview.src = URL.createObjectURL(file);
                }
            } else {
                previewContainer.classList.add('d-none');
                uploadLabel.textContent = 'Klik atau seret file ke sini untuk mengunggah';
            }
        });
        const uploadArea = document.querySelector('.upload-area');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.classList.add('border-primary');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('border-primary');
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            inputFile.files = dt.files;
            const event = new Event('change');
            inputFile.dispatchEvent(event);
        }
    });
</script>


<style>
    .upload-area {
        border: 2px dashed #dee2e6;
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #0d6efd;
    }

    .upload-label {
        display: block;
        margin: 0;
    }

    .img-preview,
    .video-preview {
        background-color: #f8f9fa;
        padding: 0.5rem;
    }
</style>

<script>
    document.getElementById('image_path').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const file = e.target.files[0];

        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                preview.classList.add('d-none');
            }
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
