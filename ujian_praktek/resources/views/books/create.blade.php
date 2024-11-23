@extends('layouts.app')

@section('content')
    <h1>Create Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" required><br>
        <label for="author">Author</label>
        <input type="text" name="author" required><br>
        <label for="categories">Categories</label>
        <select name="category_ids[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>
        <label for="member_id">Borrower</label>
        <select name="member_id">
            @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select><br>
        <button type="submit">Create Book</button>
    </form>
@endsection
