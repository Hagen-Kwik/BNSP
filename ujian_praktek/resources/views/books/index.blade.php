@extends('layouts.app')

@section('content')
    <h1>Books List</h1>
    <a href="{{ route('books.create') }}">Add Book</a>
    <ul>
        @foreach ($books as $book)
            <li>{{ $book->title }} - {{ $book->author }}
                <a href="{{ route('books.edit', $book) }}">Edit</a>
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
