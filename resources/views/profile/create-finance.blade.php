@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Finance Details</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.store-finance') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary">
                    </div>

                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name">
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number">
                    </div>

                    <div class="mb-3">
                        <label for="pan_number" class="form-label">PAN Number</label>
                        <input type="text" class="form-control" id="pan_number" name="pan_number">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('my-profile') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection