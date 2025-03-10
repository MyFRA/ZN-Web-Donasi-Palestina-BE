@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Virtual Bank Accounts</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Virtual Bank Accounts</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 80px">Image</th>
                                        <th>Bank Name</th>
                                        <th>Bank Short Name</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bank_accounts as $index => $donation)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ url('/storage/virtual-bank-accounts/image/' . $donation->image) }}" width="80px" alt="">
                                            </td>
                                            <td>{{ $donation->bank_name }}</td>
                                            <td>{{ $donation->bank_short_code }}</td>
                                            <td>
                                                <a href="{{ url('/panel/bank-accounts/' . $donation->id . '/edit') }}" class="btn btn-sm btn-primary">
                                                    <i class="zmdi zmdi-edit"></i> Edit
                                                </a>
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
