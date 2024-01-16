@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Edit Paket Donasi</strong></h1>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ url('/panel/donation-packages/' . $donationPackage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="short_description">Nama Paket</label>
                                <input type="text" name="short_description" class="form-control @error('short_description') is-invalid @enderror" id="short_description" placeholder="Nama Paket" value="{{ old('short_description') ? old('short_description') : $donationPackage->short_description }}">

                                @error('short_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="title">Nominal Paket (Judul)</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Nominal Paket (Judul)" value="{{ old('title') ? old('title') : $donationPackage->title }}">

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="value">Nominal Paket</label>
                                <input type="number" name="value" class="form-control @error('value') is-invalid @enderror" id="value" placeholder="Nominal Paket" value="{{ old('value') ? old('value') : $donationPackage->value }}">

                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deksripsi</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Deksripsi" cols="30" rows="10">{{ old('description') ? old('description') : $donationPackage->description }}</textarea>

                                @error('description')
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
