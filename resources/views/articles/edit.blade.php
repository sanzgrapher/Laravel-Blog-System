@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px">
    @if ($errors->any())
    <div class="alert alert-warning text-center">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="">Title</label>
            <input name="title" type="text" class="form-control" value="{{ $article->title }}" required>
        </div>

        <div class="mb-3">
            <label for="">Old Image</label>
            <img src="{{ asset('images/' . $article->image) }}" class="card-img-top" alt="Sample Image"
                style="height: 250px; object-fit: cover;">
        </div>

        <div class="mb-3">
            <label for="">New Image (Optional)</label>
            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
        </div>

        <input type="hidden" name="old_image" value="{{ $article->image }}">

        <div class="mb-3">
            <label for="">Body</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control"
                required>{{ $article->body }}</textarea>
        </div>

        <div class="mb-3">
            <label>Select Category</label><br>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category_option" id="existing_category"
                    value="existing" checked>
                <label class="form-check-label" for="existing_category">Select Existing Category</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category_option" id="add_new_category" value="new">
                <label class="form-check-label" for="add_new_category">Add New Category</label>
            </div>

            <!-- Existing Categories Dropdown -->
            <div id="existingCategoryContainer">
                <select name="category_id" class="form-select mt-2">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($article->category_id === $category->id)>{{
                        $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- New Category Input -->
            <div id="newCategoryContainer" style="display: none;">
                <input type="text" name="new_category_name" class="form-control mt-2"
                    placeholder="Enter new category name">
            </div>
        </div>

        <button class="btn btn-primary w-100">Update</button>
    </form>
</div>

<script>
    // JavaScript to toggle between existing category dropdown and new category input
        document.querySelectorAll('input[name="category_option"]').forEach((radio) => {
            radio.addEventListener('change', function () {
                const existingCategoryContainer = document.getElementById('existingCategoryContainer');
                const newCategoryContainer = document.getElementById('newCategoryContainer');

                if (this.value === 'existing') {
                    existingCategoryContainer.style.display = 'block';
                    newCategoryContainer.style.display = 'none';
                } else {
                    existingCategoryContainer.style.display = 'none';
                    newCategoryContainer.style.display = 'block';
                }
            });
        });
</script>
@endsection