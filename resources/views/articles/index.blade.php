@extends('layouts.app')

@section('content')
  <div class="container mt-4">

  

    <!-- Info Alert -->
    @if (session('info'))
    <div class="alert alert-info text-center mb-4">
        {{ session('info') }}
    </div>
    @endif

    <!-- Articles Grid -->
    <div class="row">
        @foreach ($articles as $article)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <img src="{{ asset('images/' . $article->image) }}" class="card-img-top" alt="Sample Image"
                        style="height: 200px; object-fit: cover;">

                    <h5 class="card-title">{{ $article->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        By {{ $article->user->name }},
                        <span>{{ $article->created_at->diffForHumans() }}</span>,
                        <span>Category: {{ $article->category->name }}</span>
                    </h6>
                    <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                    <a href="{{ url("/articles/detail/$article->id") }}" class="btn btn-primary">Read More &raquo;</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- No articles message -->
    @if ($articles->isEmpty())
    <div class="alert alert-warning text-center">
        No articles found.
    </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mb-4">
        {{ $articles->links() }}
    </div>

</div>
@endsection