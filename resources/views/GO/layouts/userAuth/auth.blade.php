@extends('GO.layouts.app')

@section('auth')
    @include('GO.layouts.userAuth.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        @include('GO.layouts.userAuth.nav')
        <div class="container-fluid py-4">
            @yield('content')
            @include('GO.layouts.userAuth.footer')
        </div>
    </main>

    @include('components.fixed-plugin')
@endsection
