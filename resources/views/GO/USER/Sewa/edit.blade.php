@extends('GO.layouts.userAuth.auth')
@section('title', 'Order')
@section('content')
    <div class="row justify-content-start">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header pb-2  text-center">
                    <h5>Edit User</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" method="post" action="{{ route('admin.users.update',$user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                aria-label="Name" aria-describedby="name" value="{{old('name',$user->name)}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                aria-label="Email" aria-describedby="email-addon" value="{{old('email',$user->email)}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="choices form-select @error('role') is-invalid @enderror" name="role" id="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @if($user->role->value == $role) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" placeholder="-" name="phone"
                                id="phone" aria-label="phone" aria-describedby="phone-addon"
                                value="{{old('phone',$user->phone)}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ route('admin.users.index')}}" class="btn bg-gradient-danger w-100 my-4 mb-2">Back</a>
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
