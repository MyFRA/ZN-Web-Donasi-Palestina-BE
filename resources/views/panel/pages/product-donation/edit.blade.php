@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Edit Produk Donasi</strong></h1>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ url('/panel/product-donations/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <img src="{{ url('/storage/products/image/' . $product->image) }}" width="75px" alt="" id="image-preview"><br>
                                <label for="image">Gambar</label>
                                <input type="file" accept="image/*" name="image" class="form-control @error('image') is-invalid @enderror" id="image" onchange="setImagePreview(this)">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama produk</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama produk" value="{{ old('name') ? old('name') : $product->name }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Harga</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Harga" value="{{ old('price') ? old('price') : $product->price }}">

                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="weight">Berat (gr)</label>
                                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" placeholder="Berat (gr)" value="{{ old('weight') ? old('weight') : $product->weight }}">

                                @error('weight')
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
