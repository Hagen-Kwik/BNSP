@extends('layouts.app')

@section('content')
    <h1>Members List</h1>
    <a href="{{ route('members.create') }}">Add Member</a>
    <ul>
        @foreach ($members as $member)
            <li>
                {{ $member->name }} - {{ $member->email }}
                <a href="{{ route('members.edit', $member) }}">Edit</a>
                <form action="{{ route('members.destroy', $member) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
