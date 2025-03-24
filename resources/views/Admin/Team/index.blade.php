@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Team Members</h2>
    <a href="{{ route('team.create') }}" class="btn btn-success mb-3">Add Team Member</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{ $team->name }}</td>
                <td>{{ $team->designation }}</td>
                <td><img src="{{ asset('storage/' . $team->image) }}" height="50"></td>
                <td>
                    <a href="{{ route('team.edit', $team->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('team.destroy', $team->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this member?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
