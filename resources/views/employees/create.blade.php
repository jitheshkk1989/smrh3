@extends('layouts.app') {{-- Assuming you are using the same app layout --}}

@section('content')
<div class="container mt-4">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create New Employee</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <p>Fill in the details below to create a new employee and their associated user account.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
            <form method="POST" action="{{ route('employees.store') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email (Username):</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="employee_code">Employee Code:</label>
                        <input type="text" class="form-control" id="employee_code" name="employee_code" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position">Position:</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="company_id">Company:</label>
                        <select name="company_id" id="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="user_group_id">User Group:</label>
                        <select name="user_group_id" id="user_group_id" class="form-control" required>
                            <option value="">Select User Group</option>
                            @foreach($userGroups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address"></textarea>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pincode">Pincode:</label>
                        <input type="text" class="form-control" id="pincode" name="pincode">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hire_date">Hire Date:</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date">
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="terminated">Terminated</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Create Employee</button>
            </form>
        </div>
    </div>
</div>
@endsection