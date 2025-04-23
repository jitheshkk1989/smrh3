<div class="card mt-4">
    <div class="card-body">
        <h5>Contact Details</h5>
        @if ($employee->contactDetail)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Permanent Address</th>
                        <td>{{ $employee->contactDetail->permanent_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Current Address</th>
                        <td>{{ $employee->contactDetail->current_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Emergency Phone</th>
                        <td>{{ $employee->contactDetail->phone_emergency ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editContactModal">Edit</button>
        @else
            <p>No contact details found.</p>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editContactModal">Add Details</button>
        @endif
    </div>
</div>

<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">Edit Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update-contact') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <textarea class="form-control" id="permanent_address" name="permanent_address">{{ $employee->contactDetail->permanent_address ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="current_address" class="form-label">Current Address</label>
                        <textarea class="form-control" id="current_address" name="current_address">{{ $employee->contactDetail->current_address ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone_emergency" class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" id="phone_emergency" name="phone_emergency" value="{{ $employee->contactDetail->phone_emergency ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>