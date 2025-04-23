<div class="card mt-4">
    <div class="card-body">
        <h5>Professional Details</h5>
        @if ($employee->professionalDetail)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Department</th>
                        <td>{{ $employee->professionalDetail?->department ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td>{{ $employee->professionalDetail?->designation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Joining Date</th>
                        <td>{{ $employee->professionalDetail?->joining_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td>{{ $employee->professionalDetail?->experience ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfessionalModal">Edit</button>
        @else
            <p>No professional details found.</p>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfessionalModal">Add Details</button>
        @endif
    </div>
</div>

<div class="modal fade" id="editProfessionalModal" tabindex="-1" aria-labelledby="editProfessionalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfessionalModalLabel">Edit Professional Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update-professional') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{ $employee->professionalDetail?->department ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="{{ $employee->professionalDetail?->designation ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $employee->professionalDetail?->joining_date ? $employee->professionalDetail?->joining_date->format('Y-m-d') : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" value="{{ $employee->professionalDetail?->experience ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>