@extends('GO.layouts.userAuth.auth')
@section('title', 'Kendaraan')
@section('content')
    <div class="row ">
        <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 font-weight-bolder">Total Kendaraan <span
                                        class="text-xs font-weight-bold">(Motor/Mobil/Bus)</span></p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $kendaraans->count() }}
                                    <span class="text-sm font-weight-bolder">
                                        ({{ $kendaraans->where('tipe_kendaraan_id', 1)->count() }} /
                                        {{ $kendaraans->where('tipe_kendaraan_id', 2)->count() }} /
                                        {{ $kendaraans->where('tipe_kendaraan_id', 3)->count() }})
                                    </span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-car text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Kendaraan Anda</h5>
                        </div>
                        <a href="{{ route('owner.kendaraan.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">+&nbsp; Tambah Kendaraan</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NO</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Kendaraan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Merek Kendaraan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Kendaraan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Plat Nomor</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraans as $kendaraan)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <img src="{{ asset('assets/img/vehicle-images/' . $kendaraan->foto) }}"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $kendaraan->nama }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $kendaraan->merk }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $kendaraan->jenisKendaraan->nama }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $kendaraan->plat }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('owner.kendaraan.show', $kendaraan->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="Detail Kendaraan">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            <a href="{{ route('owner.kendaraan.edit', $kendaraan->id) }}" class="mx-2"
                                                data-bs-toggle="tooltip" data-bs-original-title="Edit Kendaraan">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('owner.kendaraan.destroy', $kendaraan->id) }}" class="mx-2"    
                                                data-bs-toggle="tooltip" data-confirm-delete="true" data-bs-original-title="Delete Kendaraan">
                                                <i class="fas fa-trash text-secondary"></i>
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
@endsection
