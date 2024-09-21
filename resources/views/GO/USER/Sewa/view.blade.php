@extends('GO.layouts.userAuth.auth')
@section('title', 'Order Details')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold mb-0">Order detail {{ $order->kendaraan->nama }}</h3>
                </div>

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Detail Sewa</h5>
                            <a href="{{ route('user.order.index') }}" class="btn bg-gradient-light btn-sm m-0">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Vehicle Image -->
                                <img src="{{ asset('assets/img/vehicle-images/' . $order->kendaraan->foto) }}"
                                    class="img-fluid rounded" alt="{{ $order->kendaraan->nama }}">
                            </div>
                            <div class="col-md-7 mx-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-uppercase text-sm font-weight-bold" style="width: 40%;">
                                                    <h6> Informasi</h6>
                                                </td>
                                                <td class="text-uppercase text-sm font-weight-bold">
                                                    <h6> Detail</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold">Nama Kendaraan</td>
                                                <td>{{ $order->kendaraan->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold border">Harga Kendaraan</td>
                                                <td class="border">Rp
                                                    {{ number_format($order->kendaraan->harga, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold">Tanggal Sewa</td>
                                                <td>{{ $order->tanggal_sewa }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold">Tanggal Pengembalian</td>
                                                <td>{{ $order->tanggal_pengembalian }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold">Lama Sewa</td>
                                                <td>{{ $order->durasi_sewa }} hari</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold">Total Harga</td>
                                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-bold border">Status Sewa</td>
                                                <td>{{ $order->status_sewa }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-4 py-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Data Pembayaran </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="accordion" id="accordionPembayaran">
                            @forelse ($pembayarans as $pembayaran)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed py-1" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
                                            aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                            Data Pembayaran {{ $loop->iteration }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $loop->iteration }}"
                                        data-bs-parent="#accordionPembayaran" style="">
                                        <div class="accordion-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>Pembayaran Via</th>
                                                        <td>
                                                            <p class="m-0">{{ $pembayaran->metode_pembayaran }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tipe Pembayaran</th>
                                                        <td>
                                                            <p class="m-0">{{ $pembayaran->detail_pembayaran }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jumlah Dibayarkan</th>
                                                        <td>
                                                            <p class="m-0">{{ $pembayaran->jumlah_pembayaran }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Pembayaran</th>
                                                        <td class="text-center">
                                                            <p @class([
                                                                'mb-0 p-1 rounded',
                                                                'bg-gradient-success text-white' =>
                                                                    $pembayaran->status_pembayaran == 'diterima',
                                                                'bg-gradient-danger text-white' =>
                                                                    $pembayaran->status_pembayaran == 'ditolak',
                                                                'bg-gradient-light text-black' =>
                                                                    $pembayaran->status_pembayaran == 'menunggu',
                                                            ])>
                                                                {{ $pembayaran->status_pembayaran }}</p>
                                                        </td>
                                                        {{-- <td>{{$pembayaran->status_pembayaran}}</td> --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning" role="alert">
                                    Belum Melakukan Pembayaran
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('user.order.pay', $order) }}" class="mx-auto rounded-2 align-self-center bg-success py-2 px-4" data-bs-toggle="tooltip"
                                        data-bs-original-title="Payment">
                                        <i class="fa fa-money text-dark"></i>
                                        <span>Payment Now</span>
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
