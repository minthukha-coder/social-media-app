@extends('layouts.master')
@section('content')
    <div class="row d-flex justify-content-center">
        @if (session()->has('successMsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('successMsg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-md-4 mt-3">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post">
                @csrf @if (isset($post))
                    @method('put')
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ old('title') ?? ($post->title ?? '') }}"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">Body</label>
                    <textarea name="body" rows="3" value="{{ old('body') }}"
                        class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? ($post->body ?? '') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-sm">{{ isset($post) ? 'Update' : 'Submit' }}</button>
            </form>
        </div>
        <div class="row">
            @if ($posts->isEmpty())
                <p>No Post Available</p>
            @else
                @foreach ($posts as $post)
                    <div class="col-md-4 mt-3">
                        <div class="card border-info mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-info">{{ $post->title }}</div>
                            <div class="card-body d-flex justify-content-between">
                                <h6>{{ $post->body }}</h6>
                                <div class="icon mx-2">
                                    @if (Auth::check() && $post->user_id == Auth::user()->id)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf @method('delete')
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="btn btn-warning btn-sm my-1"><i class="bi bi-pencil-square"></i></a>
                                            <button class="btn btn-danger btn-sm my-1"
                                                onclick="return confirm('Are you sure to delete this?')"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="btn border border-danger my-1">Detail</a>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-info text-end fw-bold">Post By
                                {{ $post->user->name }}
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
