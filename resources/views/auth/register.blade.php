@extends('auth.master')
@section('content')
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4">
            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <h3 class="text-center fw-bold">Register Form</h3>

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

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
                <button class="btn btn-primary btn-block w-100">Register</button>
                <a href="{{ route('login') }}" class="btn btn-block border border-primary w-100 mt-2">
                    You have An Account? Login </a>
            </form>

        </div>
    </div>
@endsection
