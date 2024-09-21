@extends('GO.layouts.userAuth.auth')
@section('title', 'Pengembalian')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center bg-gradient-primary">
                    <h5 class="text-white m-0">Edit Pengembalian</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="post" action="{{ route('admin.pengembalians.update',$pengembalian->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                           <label for="nama" class="form-label">Kendaraan</label>
                           <input type="text" class="form-control" placeholder="Kendaraan" name="nama" id="nama"
                               aria-label="Kendaraan" aria-describedby="nama" value="{{ old('nama', $pengembalian->sewa->kendaraan->nama) }}" readonly>
                       </div>
                       <div class="mb-3">
                        <label for="masalah" class="form-label"><strong>Masalah</strong></label>
                        <select class="form-select" name="masalah" id="masalah" required value="{{old('masalah',$pengembalian->masalah)}}" textarea>
                            <option value="0">Tidak ada masalah</option>
                            <option value="1">Ada masalah</option>
                        </select>
                        </div>                       
                        <div class="mb-3">
                           <label for="kondisi" class="form-label">Kondisi Kendaraan</label>
                           <input type="kondisi" class="form-control" placeholder="Kondisi Kendaraan" name="kondisi" id="kondisi"
                               aria-label="Kondisi Kendaraan" aria-describedby="kondisi" value="{{old('kondisi',$pengembalian->kondisi)}}" textarea>
                       </div>                                              
                        <div class="mb-3">
                           <label for="tanggal_pengembalian" class="form-label"><strong>Tanggal Pengembalian</strong></label>
                           <input type="date" class="form-control" name="tanggal_pengembalian" id="tanggal_pengembalian"
                               aria-label="tanggal pengembalian" aria-describedby="tanggal pengembalian" value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian) }}" required>
                           @error('tanggal_pengembalian')
                               <p class="text-danger text-xs mt-2">{{ $message }}</p>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="denda" class="form-label">Denda (Rp)</label>
                            <input type="denda" class="form-control" placeholder="Denda" name="denda" id="denda"
                                aria-label="Denda" aria-describedby="denda" value="{{old('denda',$pengembalian->denda)}}" textarea>
                        </div>
                        <input type="hidden" name="kendaraan_id" value="{{ $pengembalian->sewa->kendaraan->id }}">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.pengembalians.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

