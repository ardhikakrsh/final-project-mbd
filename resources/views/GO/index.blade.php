@extends('GO.layouts.home')
@section('title', 'Home')

@section('content')
  <section class="row">
    @foreach ($kendaraans as $kendaraan)
      <div class="col-xl-2 col-sm-6 mb-xl-6 mb-4">
        <div class="card">
          <div class="ratio ratio-1x1">
            <img src="{{ asset('assets/img/vehicle-images/' . $kendaraan->foto) }}" class="card-img-top rounded-3 p-2" alt="{{ $kendaraan->nama }}">
          </div>
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $kendaraan->nama }}</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $kendaraan->formatHarga }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <a href="{{ route('detail', $kendaraan->id) }}" class="icon icon-shape bg-gradient-faded-success shadow text-center border-radius-md">
                  <i class="fas fa-plus text-lg opacity-10" aria-hidden="true"></i>
                </a>              
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </section>
@endsection
