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

        <div class="row mt-4">
            <div class="col-lg-6">
                <form action="{{ url('/panel/setting-web-donation') }}" id="form-submit" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <h4 style="font-weight: 600">Web Donasi</h4>
                                    </div>
                                    <div class="form-group mb-3">
                                        <img src="{{ url('/storage/setting-web-donations/thumbnail/' . $setting->thumbnail) }}" width="300px" alt="" id="image-preview"><br>
                                        <label for="thumbnail">Banner</label>
                                        <input type="file" accept="image/*" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" onchange="setImagePreview(this)">

                                        @error('thumbnail')
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
                window.editor.setData(`{!! $setting->description !!}`)
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
