@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Setting Perusahaan</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col">
                <form action="{{ url('/panel/setting') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4 style="font-weight: 600">Perusahaan</h4>
                                    </div>
                                    <div class="form-group mb-3">
                                        <img src="{{ url('/storage/settings/company-logo/' . $setting->company_logo) }}" width="75px" alt="" id="image-preview"><br>
                                        <label for="company_logo">Logo</label>
                                        <input type="file" accept="image/*" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" onchange="setImagePreview(this)">

                                        @error('company_logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="company_name">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" id="company_name" placeholder="Nama" value="{{ old('company_name') ? old('company_name') : $setting->company_name }}">

                                        @error('company_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="company_description">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="company_description" id="company_description" class="form-control @error('company_description') is-invalid @enderror" style="height: 120px" placeholder="Deskripsi" cols="30" rows="10">{{ old('company_description') ? old('company_description') : $setting->company_description }}</textarea>

                                        @error('company_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4 style="font-weight: 600">Pengiriman</h4>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="shipping_province_id">Asal Provinsi <span class="text-danger">*</span></label>
                                        <select name="shipping_province_id" id="shipping_province_id" class="form-control @error('shipping_province') is-invalid @enderror" id="shipping_province">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}" {{ $province->province_id == $setting->shipping_province_id ? 'selected' : '' }}>{{ $province->province }}</option>
                                            @endforeach
                                        </select>

                                        @error('shipping_province')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="shipping_city_id">Asal Kota / Kabupaten <span class="text-danger">*</span></label>
                                        <select name="shipping_city_id" id="shipping_city_id" class="form-control @error('shipping_city') is-invalid @enderror" id="shipping_city">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->city_id }}" {{ $city->city_id == $setting->shipping_city_id ? 'selected' : '' }}>{{ $city->type . ' ' . $city->city_name }}</option>
                                            @endforeach
                                        </select>

                                        @error('shipping_city')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="additional_shipping_fee">Biaya Ongkir Tambahan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('additional_shipping_fee') is-invalid @enderror" name="additional_shipping_fee" id="additional_shipping_fee" placeholder="Biaya Ongkir Tambahan" value="{{ old('additional_shipping_fee') ? old('additional_shipping_fee') : $setting->additional_shipping_fee }}">
                                        <small>Biaya ongkir = Biaya Tambahan + Biaya Ongkir Asli</small>

                                        @error('additional_shipping_fee')
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
                            <button type="submit" class="btn btn-primary">
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
    <script>
        function setImagePreview(elem) {
            if (elem.files.length > 0) {
                const imagePreviewElement = document.getElementById('image-preview')
                imagePreviewElement.setAttribute('src', URL.createObjectURL(elem.files[0]))
            }
        }
    </script>
@endsection
