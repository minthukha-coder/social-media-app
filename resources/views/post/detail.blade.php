@extends('layouts.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-3">
        <h4 class="text-center fw-bold mt-3">Detail Page</h4>
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="bi bi-backspace"></i> Back</a>
    </div>
    @if (session()->has('successMsg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('successMsg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card border-info mb-3">
                <div class="card-header bg-transparent border-info">{{ $post->title }}</div>
                <div class="card-body d-flex justify-content-between">
                    <h6>{{ $post->body }}</h6>
                </div>
                <div class="card-footer bg-transparent border-info text-end fw-bold">Post By
                    {{ $post->user->name }}
                </div>

            </div>
            <button class="btn btn-primary btn-sm float-end mb-4" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                View Comment - {{ count($comments) }}
            </button>
            <div style="min-height: 120px;" class="mt-5">
                <div class="collapse collapse-horizontal" id="collapseWidthExample">
                    <form action="{{ route('comment.store', $post->id) }}" method = "post">
                        @csrf
                        <textarea name="text" value="{{ old('text') }}" rows="3" class="form-control" required></textarea>
                        <button class="btn btn-success btn-sm my-2">Comment</button>
                    </form>

                    @if ($comments->isEmpty())
                        <p class="fw-bold">No Comment in this post!</p>
                    @else
                        @foreach ($comments as $comment)
                            <div class="card card-body my-2">
                                <div class="d-flex justify-content-between">
                                    <p>{{ $comment->text }}</p>
                                    <p class="fw-bold">Comment By {{ $comment->user->name }}</p>
                                </div>
                                <div class="action">
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                        @csrf @method('delete')
                                        @if (Auth::check() && Auth::user()->id == $comment->user_id)
                                            <a href="{{ route('comment.edit', $comment->id) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure to delete this?')"><i
                                                    class="bi bi-trash"></i></button>
                                        @else
                                            @if (Auth::user()->id == $comment->post->user->id)
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure to delete this?')"><i
                                                        class="bi bi-trash"></i></button>
                                            @endif
                                        @endif

                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
