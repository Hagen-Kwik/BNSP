@extends('layouts.app')

@section('content')
    <h1>Create New Book</h1>

    <!-- Create Book Form -->
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categories</label>
            <select name="category_ids[]" id="categories" class="form-control" multiple required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="member_id" class="form-label">Borrower</label>
            <select name="member_id" id="member_id" class="form-control">
                <option value="">Select a member</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create Book</button>
    </form>
@endsection
