@extends('GO.layouts.userAuth.auth')
@section('title', 'Pembayaran')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Data Transaksi Pembayaran</h5>
                            <a href="{{ route('admin.pembayarans.index') }}"
                                class="btn bg-gradient-light btn-sm m-0">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 align-content-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered table">
                                        <tr>
                                            <th>Data Kendaraan</th>
                                            <td>
                                                <ul>
                                                    <li>Kendaraan : {{ $pembayaran->sewa->kendaraan->nama }}</li>
                                                    <li>Penyewa : {{ $pembayaran->sewa->pelanggan->user->name }}</li>
                                                    <li>Tanggal Sewa : {{ $pembayaran->sewa->tanggal_sewa }}</li>
                                                    <li>Tanggal Pengembalian : {{ $pembayaran->sewa->tanggal_pengembalian }}</li>
                                                    <li>Total Harga : {{ $pembayaran->sewa->formatHarga() }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                            <tr>
                                                <th>Metode Pembayaran</th>
                                                <td>{{$pembayaran->metode_pembayaran}}</td>
                                            </tr>
                                            <tr>
                                                <th>Detail Pembayaran</th>
                                                <td>{{$pembayaran->detail_pembayaran}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pembayaran</th>
                                                <td>
                                                    <p class="text-center text-xs font-weight-bold mb-0 p-1 rounded"
                                                    style="width: {{ strlen($pembayaran->status_pembayaran) * 9 }}px;
                                                           @if($pembayaran->status_pembayaran == 'diterima') background: linear-gradient(87deg, #28a745 0, #28a745 100%);
                                                               color: white;
                                                           @elseif($pembayaran->status_pembayaran == 'ditolak') background: linear-gradient(87deg, #dc3545 0, #dc3545 100%);
                                                               color: white;
                                                           @elseif($pembayaran->status_pembayaran == 'menunggu') background: linear-gradient(87deg, #f8f9fa 0, #f8f9fa 100%);
                                                               color: black;
                                                           @elseif($pembayaran->status_pembayaran == 'revisi') background: linear-gradient(87deg, #ffc107 0, #ffc107 100%);
                                                               color: black;
                                                           @endif">
                                                    {{ $pembayaran->status_pembayaran }}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Dibayarkan</th>
                                                <td>{{$pembayaran->formatHarga()}}</td>
                                            </tr>
                                            <tr>
                                                <th>Bukti Pembayaran</th>
                                                <td>
                                                    <div class="card">
                                                        <img src="{{ asset('assets/img/payment-proof/' . $pembayaran->bukti_pembayaran) }}"
                                                            class="card-img" style="max-width: 400px; max-height: 400px;" alt="Bukti: {{$pembayaran->bukti_pembayaran }}">
                                                    </div>
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3 text-center">
                                <form method="POST" action="{{ route('admin.pembayarans.verify', $pembayaran->id) }}">
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-info w-30 my-4 mb-2">Verify</button>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
