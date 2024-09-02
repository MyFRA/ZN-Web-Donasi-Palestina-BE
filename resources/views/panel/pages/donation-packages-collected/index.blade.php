@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Paket Donasi (Terkumpul)</strong></h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Paket Donasi (Terkumpul)</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><b>Rp{{ number_format($total, 0, '.', '.') }}</b></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Paket Donasi (Terkumpul)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Paket Donasi</th>
                                        <th>Jumlah</th>
                                        <th>Nominal</th>
                                        <th>Nama Lengkap</th>
                                        <th>Nomor Whatsapp</th>
                                        <th>Email</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $key => $donation)
                                        <tr>
                                            <td>{{ $donations->firstItem() + $loop->index }}</td>
                                            <td><b>{{ $donation->availableDonation->short_description }}</b></td>
                                            <td><b>{{ $donation->availableDonation->value == 'lainnya' ? '-' : 'Rp' . number_format($donation->package_item_price, 0, '.', '.') . ' x ' . $donation->amount_package }}</b></td>
                                            <td><b>Rp{{ number_format($donation->amount, 0, '.', '.') }}</b></td>
                                            <td>{{ $donation->fullname }}</td>
                                            <td>{{ $donation->whatsapp_number }}</td>
                                            <td>{{ $donation->email }}</td>
                                            <td>{{ $donation->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $donations->links() }}
            </div>
        </div>
    </div>
@endsection
