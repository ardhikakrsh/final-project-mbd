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
                        <a href="{{ route('admin.orders.index') }}" class="btn bg-gradient-light btn-sm m-0">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 align-content-center">
                            <!-- Vehicle Image -->
                            <div class="ratio ratio-1x1">
                                <img src="{{ asset('assets/img/vehicle-images/' . $order->kendaraan->foto) }}" class="card-img-top rounded-3 p-1" alt="{{ $order->kendaraan->nama }}">
                            </div>
                        </div>
                        <div class="col-md-7 mx-2">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Nama Kendaraan</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->kendaraan->nama }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Tanggal Sewa</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->tanggal_sewa }}</p>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Tanggal Pengembalian</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->tanggal_pengembalian }}</p>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Lama Sewa</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->durasi_sewa }} hari</p>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Harga Kendaraan</th>
                                            <td>
                                                <p class="text-sm mb-0">Rp {{ number_format($order->kendaraan->harga, 0, ',', '.') }}</p>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Total Harga</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->formatHarga() }}</p>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <td class="text-sm font-weight-bold mb-0">Status Sewa</td>
                                            <td>
                                                <p @class([
                                                'text-sm p-1 rounded m-0 h-auto text-center', 
                                                'bg-gradient-success text-white' => $order->status_sewa == 'diterima',
                                                'bg-gradient-danger text-white' => $order->status_sewa == 'ditolak',
                                                'bg-gradient-light text-black' => $order->status_sewa == 'menunggu',
                                            ])>
                                                    {{ $order->status_sewa }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-sm font-weight-bold mb-0">Disewa</th>
                                            <td>
                                                <p class="text-sm mb-0">{{ $order->pelanggan->user->name }}</p>
                                            </td>
                                        </tr>  
                                </table>
                                <div class="row-md- text-center">
                                    <form method="POST" action="{{ route('admin.orders.verify', $order->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Check Status</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
