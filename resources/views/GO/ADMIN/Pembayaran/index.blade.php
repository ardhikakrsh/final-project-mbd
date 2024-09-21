@extends('GO.layouts.userAuth.auth')
@section('title', 'Pembayaran')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pembayaran</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $countPembayaran['totalPembayaran'] }}
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Harga Bayar</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp{{ number_format($countPembayaran['totalHargaBayar'], 0, ',', '.') }}
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
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Pembayaran Sewa</h5>
                        </div>
                        <a href="{{ route('admin.pembayarans.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                            type="button">+&nbsp; Tambah Pembayaran</a>
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
                                        Metode Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Detail Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah Bayar (Rp)
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pembayaran->metode_pembayaran}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pembayaran->detail_pembayaran}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$pembayaran->formatHarga()}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p @class([
                                                'text-xs font-weight-bold mb-0 p-1 rounded',
                                                'bg-gradient-success text-white' => $pembayaran->status_pembayaran == 'diterima',
                                                'bg-gradient-danger text-white' => $pembayaran->status_pembayaran == 'ditolak',
                                                'bg-gradient-light text-black' => $pembayaran->status_pembayaran == 'menunggu',
                                                'bg-gradient-warning text-white' => $pembayaran->status_pembayaran == 'revisi',
                                            ])>{{ $pembayaran->status_pembayaran }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pembayarans.show', $pembayaran->id) }}" class="mx-2" data-bs-toggle="tooltip"
                                                data-bs-original-title="View pembayaran">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.pembayarans.edit', $pembayaran->id) }}" class="mx-2" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit pembayaran">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.pembayarans.destroy', $pembayaran->id) }}"    
                                                class="mx-2" data-bs-toggle="tooltip" data-confirm-delete="true" data-bs-original-title="Delete pembayaran">
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
