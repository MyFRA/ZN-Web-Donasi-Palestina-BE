@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Paket Donasi</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ url('/panel/donation-packages/create') }}" class="mt-2 btn btn-success"><i class="zmdi zmdi-plus"></i> Tambah Paket Donasi</a>

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Paket Donasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Paket</th>
                                        <th>Nominal Paket (Judul)</th>
                                        <th>Nominal Paket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $index => $donation)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $donation->short_description }}</td>
                                            <td>{{ $donation->title }}</td>
                                            <td>{{ $donation->value }}</td>
                                            <td>
                                                <a href="{{ url('/panel/donation-packages/' . $donation->id . '/edit') }}" class="btn btn-sm btn-primary">
                                                    <i class="zmdi zmdi-edit"></i> Edit
                                                </a>
                                                <button onclick="onDelete(this)" data-url="{{ url('/panel/donation-packages/' . $donation->id) }}" type="button" class="btn btn-sm btn-danger">
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
