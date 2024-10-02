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

    <form method="post" enctype="multipart/form-data" id="articleForm">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" id="" cols="30" rows="5" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label>Select Category</label><br>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category_option" id="existing_category"
                    value="existing">
                <label class="form-check-label" for="existing_category">Select Existing Category</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category_option" id="add_new_category" value="new">
                <label class="form-check-label" for="add_new_category">Add New Category</label>
            </div>

            <!-- Existing Categories Dropdown -->
            <div id="existingCategoryContainer" style="display: none;">
                <select name="category_id" class="form-select mt-2" id="existingCategorySelect">
                    <option value="">Select a category</option> <!-- Default placeholder -->
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- New Category Input -->
            <div id="newCategoryContainer" style="display: none;">
                <input type="text" name="new_category_name" class="form-control mt-2"
                    placeholder="Enter new category name" id="newCategoryInput" required>
            </div>
        </div>

        <button class="btn btn-primary w-100">Post</button>
    </form>
</div>

<script>
    // JavaScript to toggle between existing category dropdown and new category input
    document.querySelectorAll('input[name="category_option"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            const existingCategoryContainer = document.getElementById('existingCategoryContainer');
            const newCategoryContainer = document.getElementById('newCategoryContainer');
            const existingCategorySelect = document.getElementById('existingCategorySelect');
            const newCategoryInput = document.getElementById('newCategoryInput');

            if (this.value === 'existing') {
                existingCategoryContainer.style.display = 'block';
                newCategoryContainer.style.display = 'none';
                existingCategorySelect.required = true; // Make existing category select required
                newCategoryInput.required = false; // Make new category input not required
            } else {
                existingCategoryContainer.style.display = 'none';
                newCategoryContainer.style.display = 'block';
                existingCategorySelect.required = false; // Make existing category select not required
                newCategoryInput.required = true; // Make new category input required
            }
        });
    });

    // Form submission event
    document.getElementById('articleForm').addEventListener('submit', function (event) {
        const selectedOption = document.querySelector('input[name="category_option"]:checked');
        if (!selectedOption) {
            event.preventDefault(); // Prevent form submission if no radio button is selected
            alert('Please select a category option (existing or new).');
        }
    });
</script>
@endsection