@extends('GO.layouts.userAuth.auth')
@section('title', 'Kendaraan')
@section('content')

<div class="row mt-4">
    <div class="mb-lg-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{ route('owner.kendaraan.index') }}" class="btn bg-gradient-primary btn-m mx-3 my-2 py-2" type="button"><i class="fas fa-arrow-left"></i></a>
                        <div class="d-flex flex-column mx-3">
                            <h6 class="mb-1 pt-2 text-bold"><u>Kendaraan Anda</u></h6>
                            <h3 class="font-weight-bolder">{{ $kendaraan->nama }} <span class=" font-weight-bold fs-5">/ {{ $kendaraan->plat }}</span></h3>
                            <h2 class="font-weight-bolder text-success"> {{ $kendaraan->formatHarga }}</h2>
                            <hr>
                            <div class="row">
                                <h6 class="col-5">Merek Kendaraan :</h6>
                                <h6 class="col-6">{{ $kendaraan->merk }}</h6>
                            </div>
                            <div class="row">
                                <h6 class="col-5">Jenis Kendaraan :</h6>
                                <h6 class="col-6">{{ $kendaraan->jenisKendaraan->nama }}</h6>
                            </div>
                            <div class="row">
                                <h6 class="col-5">Warna Kendaraan :</h6>
                                <h6 class="col-6">{{ $kendaraan->warna }}</h6>
                            </div>
                            <div class="row">
                                <h6 class="col-5">Deskripsi :</h6>
                                <h6 class="col-6">{{ $kendaraan->kondisi }}</h6>
                            </div>
                            <a href="{{ route('owner.kendaraan.edit',  $kendaraan->id) }}" class="btn bg-gradient-primary btn-sm my-2" type="button">Edit Kendaraan</a>
                        </div>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                        <div class="position-relative d-flex align-items-center justify-content-center h-100">
                            <img class="object-fit-cover card-img rounded-5 p-2 w-75" src="{{ asset('assets/img/vehicle-images/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection