@extends('panel.layouts.app')

@section('styles')
    <style>
        .ck-editor__editable {
            min-height: 150px;
        }
    </style>
@endsection

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Setting Web Donasi</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="p-0 m-0" style="list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="modalAddThumbnail" tabindex="-1" aria-labelledby="modalAddThumbnailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddThumbnailLabel">Tambah Thumbnail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/panel/setting-web-donation/thumbnail') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <img src="{{ asset('/no-image.jpg') }}" alt="" width="100px" id="image-preview">
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control" required accept="image/*" onchange="setImagePreview(this)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thumbnail</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddThumbnail">Tambah Thumbnail</button>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($thumbnails as $index => $thumbnail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ url('/storage/setting-web-donation-has-thumbnails/thumbnail/' . $thumbnail->thumbnail) }}" class="rounded" width="150px" alt=""></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="onDelete(this)" data-url="{{ url('/panel/setting-web-donation/thumbnail/' . $thumbnail->id) }}" type="button" onclick="">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="{{ url('/panel/setting-web-donation') }}" id="form-submit" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Konten</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="target_donation">Target Donasi <span class="text-danger">*</span></label>
                                        <input type="number" name="donation_target" id="donation_target" class="form-control @error('donation_target') is-invalid @enderror" placeholder="Target Donasi" value="{{ old('donation_target') ? old('donation_target') : $setting->donation_target }}">

                                        @error('donation_target')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="title">Judul <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Judul" value="{{ old('title') ? old('title') : $setting->title }}">

                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                                        <div id="description"></div>
                                        <input type="hidden" name="description" id="hidden-description">

                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="button" onclick="doSubmit()" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        window.editor;

        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: "{{ url('/api/panel-api/temp-upload-image') . '?_token=' . csrf_token() }}",
                }
            })
            .then((newEditor) => {
                window.editor = newEditor
                window.editor.setData(`{!! old('description') ? old('description') : $setting->description !!}`)
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function setImagePreview(elem) {
            if (elem.files.length > 0) {
                const imagePreviewElement = document.getElementById('image-preview')
                imagePreviewElement.setAttribute('src', URL.createObjectURL(elem.files[0]))
            }
        }
    </script>
    <script>
        function doSubmit() {
            const formSubmitElement = document.getElementById('form-submit');

            document.getElementById('hidden-description').setAttribute('value', window.editor.getData())

            formSubmitElement.submit();
        }
    </script>
@endsection
