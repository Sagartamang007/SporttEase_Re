@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add Team Member</h2>
    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>
@endsection
