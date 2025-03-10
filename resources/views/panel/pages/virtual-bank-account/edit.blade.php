@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Edit Virtual Bank Account</strong></h1>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ url('/panel/bank-accounts/' . $bankAccount->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <img src="{{ url('/storage/virtual-bank-accounts/image/' . $bankAccount->image) }}" width="75px" alt="" id="image-preview"><br>
                                <label for="image">Gambar</label>
                                <input type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" id="image" onchange="setImagePreview(this)">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" placeholder="Bank Name" value="{{ old('bank_name') ? old('bank_name') : $bankAccount->bank_name }}">

                                @error('bank_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="bank_short_code">Bank Short Code</label>
                                <input type="text" name="bank_short_code" class="form-control @error('bank_short_code') is-invalid @enderror" id="bank_short_code" placeholder="Bank Name" value="{{ old('bank_short_code') ? old('bank_short_code') : $bankAccount->bank_short_code }}">

                                @error('bank_short_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit"><i class="zmdi zmdi-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function setImagePreview(elem) {
            if (elem.files.length > 0) {
                const imagePreviewElement = document.getElementById('image-preview')
                imagePreviewElement.setAttribute('src', URL.createObjectURL(elem.files[0]))
            }
        }
    </script>
@endsection
