@extends('auth.master')
@section('content')
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4">
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                <h3 class="text-center fw-bold ">Login Form</h3>
                @if (session()->has('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('successMsg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-primary rounded-3 btn-block w-100">Login</button>

                <a href="{{ route('register') }}" class="btn btn-block border border-primary w-100 mt-2">Create New
                    Account</a>
            </form>
        </div>
    </div>
@endsection
