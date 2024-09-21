@extends('GO.layouts.userAuth.auth')
@section('title', 'Create Pengembalian')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center bg-gradient-primary">
                    <h5 class="text-white m-0">Create New Pengembalian</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="{{ route('admin.pengembalians.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="sewa_id">Select Kendaraan</label>
                            <select class="form-select" name="sewa_id" id="sewa_id" required>
                                <option value="" disabled selected>Select Kendaraan</option>
                                @foreach($sewas as $sewa)
                                    <option value="{{ $sewa->id }}">{{ $sewa->kendaraan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label"><strong>Tanggal Pengembalian</strong></label>
                            <input type="date" class="form-control" name="tanggal_pengembalian" id="tanggal_pengembalian"
                                   aria-label="Tanggal Pengembalian" aria-describedby="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" required>
                            @error('tanggal_pengembalian')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label"><strong>Kondisi Kendaraan</strong></label>
                            <textarea class="form-control" placeholder="Kondisi Kendaraan" name="kondisi" id="kondisi"
                                      aria-label="Kondisi Kendaraan" aria-describedby="kondisi" required>{{ old('kondisi') }}</textarea>
                            @error('kondisi')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="masalah" class="form-label"><strong>Masalah</strong></label>
                            <select class="form-select" name="masalah" id="masalah" required>
                                <option value="" disabled selected>Select Masalah</option>
                                <option value="0">Tidak ada masalah</option>
                                <option value="1">Ada masalah</option>
                            </select>
                            @error('masalah')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.pengembalians.index') }}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
