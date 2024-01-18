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
        <h1 class="h3 mb-3"><strong>Edit Berita</strong></h1>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ url('/panel/news/' . $news->id) }}" method="POST" id="form-submit">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="title">Judul Berita</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Judul Berita" value="{{ old('title') ? old('title') : $news->title }}">

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subtitle">Sub Judul</label>
                                <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" placeholder="Sub Judul" value="{{ old('subtitle') ? old('subtitle') : $news->subtitle }}">

                                @error('subtitle')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Konten <span class="text-danger">*</span></label>
                                <div id="content"></div>
                                <input type="hidden" name="content" id="hidden-content">

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer d-flex justify-content-end">
                            <button onclick="doSubmit()" type="button" class="btn btn-primary" type="submit"><i class="zmdi zmdi-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        window.editor;

        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ url('/api/panel-api/temp-upload-image') . '?_token=' . csrf_token() }}",
                }
            })
            .then((newEditor) => {
                window.editor = newEditor
                window.editor.setData(`{!! old('content') ? old('content') : $news->content !!}`)
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function doSubmit() {
            const formSubmitElement = document.getElementById('form-submit');

            document.getElementById('hidden-content').setAttribute('value', window.editor.getData())

            formSubmitElement.submit();
        }
    </script>
@endsection
