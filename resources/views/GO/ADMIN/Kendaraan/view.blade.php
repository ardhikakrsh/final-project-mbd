@extends('GO.layouts.userAuth.auth')
@section('title', 'Kendaraan')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">Detail {{ $kendaraan->nama }}</h5>
                            <a href="{{ route('admin.kendaraans.index') }}"
                                class="btn bg-gradient-light btn-sm m-0">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ asset('assets/img/vehicle-images/' . $kendaraan->foto) }}"
                                        class="card-img-top rounded" alt="vespa sprint s">
                                </div>
                            </div>
                            <div class="col-md-8 align-content-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered table">
                                            <tr>
                                                <th class="">Plat</th>
                                                <td>{{$kendaraan->plat}}</td>
                                            </tr>
                                            <tr>
                                                <th>Merk</th>
                                                <td>{{$kendaraan->merk}}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td>{{$kendaraan->formatHarga}}</td>
                                            </tr>
                                            <tr>
                                                <th>Warna</th>
                                                <td>{{$kendaraan->warna}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipe</th>
                                                <td>{{$kendaraan->tipeKendaraan->nama}}</td>
                                            </tr>
                                            <tr>
                                                <th>Kondisi</th>
                                                <td>{{$kendaraan->kondisi}}</td>
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
