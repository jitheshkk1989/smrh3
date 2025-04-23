@extends('layouts.app') {{-- Assuming you have a layout --}}

@section('content')
    <div class="container">
        <h1>My Profile</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Employee Details</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Employee Code</td>
                                <td>{{ $employee->employee_code }}</td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td>{{ $employee->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $employee->email ?? 'N/A' }}</td> {{-- Use ?? for nullable fields --}}
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $employee->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>{{ $employee->designation }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $employee->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $employee->city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $employee->state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{ $employee->country ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{ $employee->pincode ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Hire Date</td>
                                <td>{{ $employee->date_of_joining ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Professional Details --}}
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Professional Details</h5>
                
                @if ($employee->professionalDetail || ($employee->professionalDetails && $employee->professionalDetails->count() > 0))
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Experience</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($employee->professionalDetail as $detail)
                                        <tr>
                                            <td>{{ $detail->department ?? 'N/A' }}</td>
                                            <td>{{ $detail->designation ?? 'N/A' }}</td>
                                            <td>{{ $detail->joining_date ?? 'N/A' }}</td>
                                            <td>{{ $detail->experience ?? 'N/A' }}</td>
                                            <td><span class="table-remove"><button type="button" class="btn iq-bg-warning btn-rounded btn-sm my-0">Edit</button></span>
                                            <span class="table-remove"><button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Remove</button></span></td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No professional details found.</p>
                @endif
                <a href="{{ route('profile.create-professional') }}" class="btn btn-primary mt-3">Add New</a>
            </div>
        </div>

        {{-- Contact Details --}}
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Contact Details</h5>
                @if ($employee->contactDetail)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Permanent Address</th>
                                    <th>Current Address</th>
                                    <th>Emergency Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $employee->contactDetail->permanent_address ?? 'N/A' }}</td>
                                    <td>{{ $employee->contactDetail->current_address ?? 'N/A' }}</td>
                                    <td>{{ $employee->contactDetail->phone_emergency ?? 'N/A' }}</td>
                                    <td><a href="{{ route('profile.edit-contact') }}/{{$employee->id}}" class="btn btn-primary mt-3">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No contact details found.</p>
                    <a href="{{ route('profile.create-contact') }}" class="btn btn-primary mt-3">Add New</a>
                @endif
            </div>
        </div>

        {{-- Finance Details --}}
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Finance Details</h5>
                @if ($employee->financeDetail)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Salary</td>
                                    <td>{{ $employee->financeDetail->salary ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Bank Name</td>
                                    <td>{{ $employee->financeDetail->bank_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>{{ $employee->financeDetail->account_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>PAN Number</td>
                                    <td>{{ $employee->financeDetail->pan_number ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('profile.edit-finance') }}" class="btn btn-primary mt-3">Edit</a>
                @else
                    <p>No finance details found.</p>
                    <a href="{{ route('profile.create-finance') }}" class="btn btn-success mt-3">Add New</a>
                @endif
            </div>
        </div>
    </div>
@endsection