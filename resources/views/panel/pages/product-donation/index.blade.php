@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Produk Donasi</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ url('/panel/product-donations/create') }}" class="mt-2 btn btn-success"><i class="zmdi zmdi-plus"></i> Tambah Produk Donasi</a>

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Produk Donasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Berat (gr)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src={{ url('/storage/products/image/' . $product->image) }} width="80px" alt="">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>Rp {{ number_format($product->price, 0, '.', '.') }}</td>
                                            <td>{{ $product->weight }} gr</td>
                                            <td>
                                                <a href="{{ url('/panel/product-donations/' . $product->id . '/edit') }}" class="btn btn-sm btn-primary">
                                                    <i class="zmdi zmdi-edit"></i> Edit
                                                </a>
                                                <button onclick="onDelete(this)" data-url="{{ url('/panel/product-donations/' . $product->id) }}" type="button" class="btn btn-sm btn-danger">
                                                    <i class="zmdi zmdi-delete"></i> hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
