@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Books List</h1>

    <!-- Filter Controls -->
    <div class="mb-3 d-flex justify-content-between">
        <div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>

        <div>
            <!-- Filter by Category -->
            <form action="{{ route('books.index') }}" method="GET" class="d-inline">
                <select name="category_id" class="form-select d-inline" style="width: auto;">
                    <option value="">Select Category (All)</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info">Filter by Category</button>
            </form>

            <!-- Filter by Member -->
            <form action="{{ route('books.index') }}" method="GET" class="d-inline">
                <select name="member_id" class="form-select d-inline" style="width: auto;">
                    <option value="">Select Member (All)</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info">Filter by Member</button>
            </form>

            <!-- Clear Filters Button -->
            <form action="{{ route('books.index') }}" method="GET" class="d-inline">
                <button type="submit" class="btn btn-danger">Clear Filters</button>
            </form>
        </div>
    </div>

    <!-- Book Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Categories</th>
                <th>Borrowed By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            <span class="badge bg-info">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if ($book->member)
                            {{ $book->member->name }}
                        @else
                            <span class="text-success">Available</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
