@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 800px">

    @if (session('error'))
    <div class="alert alert-warning text-center">
        {{ session('error') }}
    </div>
    @endif

    <h2 class="mb-4">Categories List</h2>

    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $category->name }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if ($categories->isEmpty())
    <div class="alert alert-warning text-center mt-4">
        No categories found.
    </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mb-4">
        {{ $categories->links() }}
    </div>

</div>
@endsection