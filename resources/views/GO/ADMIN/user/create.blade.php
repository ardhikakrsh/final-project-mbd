@extends('GO.layouts.userAuth.auth')
@section('title', 'User')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header pb-2  text-center">
                    <h5>Create new User</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                aria-label="Name" aria-describedby="name">
                            @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                aria-label="Email" aria-describedby="email-addon">
                            @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password" aria-label="Password" aria-describedby="password-addon">
                            @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="choices form-select @error('role') is-invalid @enderror" name="role"
                                id="role" aria-placeholder="Select Role">
                                <option value="" disabled selected>Select Role</option>
                                <option value="{{ \App\Enums\RolesType::OWNER->value }}">Owner</option>
                                <option value="{{ \App\Enums\RolesType::USER->value }}">User</option>
                                <option value="{{ \App\Enums\RolesType::ADMIN->value }}">Admin</option>
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.users.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
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
