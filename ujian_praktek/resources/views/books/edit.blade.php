@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>

    <!-- Edit Book Form -->
    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categories</label>
            <select name="category_ids[]" id="categories" class="form-control" multiple required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($book->categories->contains($category->id)) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="member_id" class="form-label">Borrower</label>
            <select name="member_id" id="member_id" class="form-control">
                <option value="">Select a member</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" @if ($book->member_id == $member->id) selected @endif>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Update Book</button>
    </form>
@endsection
