@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Professional Details</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('profile.store-professional') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
            </div>
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}">
            </div>
            <div class="mb-3">
                <label for="joining_date" class="form-label">Joining Date</label>
                <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ old('joining_date') }}">
            </div>
            <div class="mb-3">
                <label for="experience" class="form-label">Experience</label>
                <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('my-profile') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection