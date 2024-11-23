@extends('layouts.app')

@section('content')
    <h1>Books List</h1>

    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>

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
