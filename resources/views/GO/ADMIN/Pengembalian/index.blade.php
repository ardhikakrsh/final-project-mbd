@extends('GO.layouts.userAuth.auth')
@section('title', 'Pengembalian')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengembalian</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $countPengembalian['totalPengembalian'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Denda</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp{{ number_format($countPengembalian['totalDenda'], 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
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
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Pengembalian Kendaraaan</h5>
                        </div>
                        <a href="{{ route('admin.pengembalians.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">+&nbsp; New Pengembalian</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kendaraan
                                    </th> 
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Masalah
                                    </th>                                                                       
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kondisi
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Denda (Rp)
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Kembali
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalians as $pengembalian)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pengembalian->sewa->kendaraan->nama}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pengembalian->formatMasalah()}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pengembalian->kondisi}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pengembalian->formatHarga()}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pengembalian->tanggal_pengembalian}}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pengembalians.show', $pengembalian->id) }}" class="mx-2" data-bs-toggle="tooltip"
                                                data-bs-original-title="View pengembalian">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.pengembalians.edit', $pengembalian->id) }}" class="mx-2" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit pengembalian">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.pengembalians.destroy', $pengembalian->id) }}"    
                                                class="mx-2" data-bs-toggle="tooltip" data-confirm-delete="true" data-bs-original-title="Delete pengembalian">
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
