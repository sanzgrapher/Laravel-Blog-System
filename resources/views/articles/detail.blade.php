@extends('layouts.app')

@section('content')
   <div class="container mt-4" style="max-width: 1024px">

    @if (session('error'))
    <div class="alert alert-warning text-center">
        {{ session('error') }}
    </div>
    @endif

    <div class="card mb-2 shadow-sm">
        <!-- Sample Image -->
        <img src="{{ asset('images/' . $article->image) }}" class="card-img-top" alt="Sample Image"
            style="height: 250px; object-fit: cover;">

        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle text-muted small mb-2">
                By {{ $article->user->name }},
                <span>{{ $article->created_at->diffForHumans() }}</span>,
                <span>Category: {{ $article->category->name }}</span>
            </div>
            <p class="card-text">{{ $article->body }}</p>

            @auth
            @if (auth()->user()->id == $article->user_id)

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-warning">Edit</a>
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
            </div>
            @endif
            @endauth
        </div>
    </div>

    <ul class="list-group mb-2">
        @if (count($article->comments))
        <li class="list-group-item list-group-item-secondary">Comments - {{ count($article->comments) }}</li>

        @foreach ($article->comments as $comment)
        <li class="list-group-item">
            @auth
@if (auth()->user()->id == $comment->user_id)
          <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
    
@endif
            @endauth

            {{ $comment->content }}
            <div>
                By <b>{{ $comment->user->name }}</b>, {{ $comment->created_at->diffForHumans() }}
            </div>
        </li>
        @endforeach
        @else
        <li class="list-group-item">No comments yet.</li>
        @endif
    </ul>

    @auth
    <form action="{{ url("/comments/add") }}" method="post">
        @csrf
        <input name="article_id" type="hidden" value="{{ $article->id }}">
        <textarea name="content" cols="30" rows="3" class="form-control mb-2" placeholder="New Comment"></textarea>
        <button class="btn btn-secondary w-100">Comment</button>
    </form>
    @endauth

</div>
@endsection