@extends('layouts.app')

@section('content')

    <h1>Categories List</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <!-- Categories Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
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
