@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Team Member</h2>
    <form action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ $team->designation }}" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset('storage/' . $team->image) }}" height="50">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
