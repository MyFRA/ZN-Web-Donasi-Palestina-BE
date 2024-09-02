@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Produk Donasi (Terkumpul)</strong></h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Produk Donasi (Terkumpul)</h5>
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
                        <h4>List Produk Donasi (Terkumpul)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat Pengiriman</th>
                                        <th>Kurir</th>
                                        <th>Detail Pembeli</th>
                                        <th>Status Pengiriman</th>
                                        <th>Produk Dibeli</th>
                                        <th>Ongkir</th>
                                        <th>Produk Dibeli + Ongkir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $key => $donation)
                                        <tr>
                                            <td>{{ $donations->firstItem() + $loop->index }}</td>
                                            <td>{{ $donation->created_at }}</td>
                                            <td>{{ $donation->full_name }}</td>
                                            <td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="showAddress{{ $donation->id }}" tabindex="-1" aria-labelledby="showAddress{{ $donation->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="showAddress{{ $donation->id }}Label">Alamat Pengiriman</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Provinsi</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->destination_province }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kabupaten / Kota</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->destination_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kecamatan</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->destination_district }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Desa</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->destination_village }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Alamat Rumah / Kantor</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->home_office_address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kode POS</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->postal_code }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showAddress{{ $donation->id }}">
                                                    <i class="zmdi zmdi-map"></i> Lihat
                                                </button>
                                            </td>
                                            <td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="showCourier{{ $donation->id }}" tabindex="-1" aria-labelledby="showCourier{{ $donation->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="showCourier{{ $donation->id }}Label">Alamat Pengiriman</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Kurir</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->courier }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Layanan Kurir</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->courier_cost_service }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Biaya</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->courier_cost_value }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Estimasi</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->courier_cost_value }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nomor Resi</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->resi_code }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showCourier{{ $donation->id }}">
                                                    <i class="zmdi zmdi-truck"></i> Lihat
                                                </button>
                                            </td>
                                            <td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="detailCustomer{{ $donation->id }}" tabindex="-1" aria-labelledby="detailCustomer{{ $donation->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailCustomer{{ $donation->id }}Label">Alamat Pengiriman</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Nama Lengkap</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->full_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nomor Telepon / Whatsapp</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->whatsapp_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <th>:</th>
                                                                            <td>{{ $donation->email }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailCustomer{{ $donation->id }}">
                                                    <i class="zmdi zmdi-account"></i> Lihat
                                                </button>
                                            </td>
                                            <td>
                                                @if ($donation->shipment_status == 'Payment Received')
                                                    <span class="badge bg-warning text-dark">{{ $donation->shipment_status }}</span>
                                                @else
                                                    <span class="badge bg-success text-light">{{ $donation->shipment_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($donation->productOrders as $productOrder)
                                                        <li>{{ $productOrder->product->name }}: Rp{{ number_format($productOrder->price, 0, '.', '.') }} x {{ $productOrder->qty }}</li>
                                                    @endforeach
                                                </ul>

                                                <span>
                                                    <b>Rp{{ number_format($donation->total, 0, '.', '.') }}</b>
                                                </span>
                                            </td>
                                            <td><b>Rp{{ number_format($donation->courier_cost_value, 0, '.', '.') }}</b></td>
                                            <td class="text-center"><b>Rp{{ number_format($donation->total + $donation->courier_cost_value, 0, '.', '.') }}</b></td>
                                            <td>
                                                @if ($donation->shipment_status == 'Payment Received')
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalSend{{ $donation->id }}" tabindex="-1" aria-labelledby="modalSend{{ $donation->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ url('/panel/product-donation-orders-collected/' . $donation->id . '/shipped') }}" method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalSend{{ $donation->id }}Label">Konfirmasi Pengiriman</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="form-group">
                                                                            <label class="mb-1" for="resi_code{{ $donation->id }}">Nomor Resi</label>
                                                                            <input type="text" name="resi_code" class="form-control" placeholder="Nomor Resi" required id="resi_code{{ $donation->id }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSend{{ $donation->id }}">
                                                        <i class="zmdi zmdi-truck"></i> Kirim
                                                    </button>
                                                @endif
                                            </td>
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
