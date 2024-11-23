@extends('layouts.app')

@section('content')
    <h1>Create Member</h1>
    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required><br>
        <label for="email">Email</label>
        <input type="email" name="email" required><br>
        <button type="submit">Create Member</button>
    </form>
@endsection
