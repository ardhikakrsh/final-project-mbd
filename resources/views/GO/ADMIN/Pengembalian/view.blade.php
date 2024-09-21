@extends('GO.layouts.userAuth.auth')
@section('title', 'Pengembalian')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Data Pengembalian Sewa</h5>
                            <a href="{{ route('admin.pengembalians.index') }}"
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
                                                        <li>Kendaraan : {{ $pengembalian->sewa->kendaraan->nama }}</li>
                                                        <li>Penyewa : {{ $pengembalian->sewa->pelanggan->user->name }}</li>
                                                        <li>Tanggal Sewa : {{ $pengembalian->sewa->tanggal_sewa }}</li>
                                                        <li>Tanggal Pengembalian : {{ $pengembalian->sewa->tanggal_pengembalian }}</li>
                                                        <li>Total Harga : {{ $pengembalian->sewa->formatHarga() }}</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Kondisi Kendaraan</th>
                                                <td>{{$pengembalian->kondisi}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Kembali</th>
                                                <td>{{$pengembalian->tanggal_pengembalian}}</td>
                                            </tr>
                                            <tr>
                                                <th>Apakah ada masalah?</th>
                                                <td>{{$pengembalian->formatMasalah()}}</td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Denda</th>
                                                <td>{{$pengembalian->formatHarga()}}</td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

