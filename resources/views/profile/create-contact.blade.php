@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Contact Details</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.store-contact') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="current_address" class="form-label">Current Address</label>
                        <textarea class="form-control" id="current_address" name="current_address" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="phone_emergency" class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" id="phone_emergency" name="phone_emergency">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('my-profile') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection