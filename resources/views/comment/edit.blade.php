@extends('layouts.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Edit Comment</h5>
        <div>
            <a href="{{ route('home') }}" class="my-3 btn btn-primary btn-sm"><i class="bi bi-backspace"></i> Back</a>
        </div>
    </div>

    @if (session()->has('successMsg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('successMsg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('comment.update', $comment->id) }}" method="post">
        @csrf @method('put')
        <div class="form-group mb-3">
            <textarea name="text" rows="3" class="form-control @error('text') is-invalid @enderror">{{ old('text') ?? $comment->text }}</textarea>
            @error('text')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary btn-sm">Update</button>
    </form>
@endsection
