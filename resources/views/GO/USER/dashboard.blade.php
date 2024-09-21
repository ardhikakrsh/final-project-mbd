@extends('GO.layouts.userAuth.auth')
@section('title', 'User Dashboard')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Order berlangsung</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $sewas->where('status_sewa', 'diterima')->count() }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Order diselesaikan</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $sewas->where('status_sewa', 'selesai')->count() }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                @if ($denda == 0)
                <p class="text-md mb-0 text-capitalize font-weight-bold">Anda tidak memiliki denda</p>
                
                @else
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Denda harus dibayar</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $denda }}
                </h5>
                @endif
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection