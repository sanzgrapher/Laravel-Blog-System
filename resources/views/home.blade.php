@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container mt-4" style="max-width: 800px">

    @if (session('error'))
    <div class="alert alert-warning text-center">
        {{ session('error') }}
    </div>
    @endif

    <h2 class="mb-4">Articles List</h2>

    <div class="container mt-5">
        <div class="row">
            <!-- Total Articles Card -->
            <div class="col-md-6">
                <div class="card text-center mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Articles</h5>
                        <p class="card-text">{{ $total_articles }} articles found.</p>
                    </div>
                    <div class="card-footer text-muted">
                        Last updated: {{ now()->format('F j, Y, g:i a') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="list-group">
        @foreach ($articles as $article)
        <div class="list-group-item d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex">
                <img width="50px" height="50px" class="m-2 rounded-1" src="{{ asset('images/' . $article->image) }}"
                    alt="">
                <div>
                    <a href="{{ url("/articles/detail/$article->id") }}" class=" text-decoration-none text-black
                        fw-bold " >
                        <h5 class="mb-1">{{ $article->title }}</h5>
                    </a>
                    <p class="mb-1 text-muted small">
                        By {{ $article->user->name }} |
                        <span>{{ $article->created_at->diffForHumans() }}</span> |
                        <span>Category: {{ $article->category->name }}</span>
                    </p>
                    <p class="mb-1">{{ Str::limit($article->body, 150) }}</p>
                </div>
            </div>
            <div>
                @auth
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-warning btn-sm me-2">Edit</a>
                <a class="btn btn-danger btn-sm" href="{{url("/articles/delete/$article->id")}}">Delete </a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>

    @if ($articles->isEmpty())
    <div class="alert alert-warning text-center mt-4">
        No articles found.
    </div>
    @endif
    <!-- Pagination -->
    <div class="d-flex justify-content-center mb-4">
        {{ $articles->links() }}
    </div>

</div>
@endsection