<div class="card mt-4">
    <div class="card-body">
        <h5>Finance Details</h5>
        @if ($employee->financeDetail)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Salary</th>
                        <td>{{ $employee->financeDetail->salary ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{ $employee->financeDetail->bank_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Account Number</th>
                        <td>{{ $employee->financeDetail->account_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>PAN Number</th>
                        <td>{{ $employee->financeDetail->pan_number ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editFinanceModal">Edit</button>
        @else
            <p>No finance details found.</p>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editFinanceModal">Add Details</button>
        @endif
    </div>
</div>

<div class="modal fade" id="editFinanceModal" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFinanceModalLabel">Edit Finance Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update-finance') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="{{ $employee->financeDetail->salary ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $employee->financeDetail->bank_name ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $employee->financeDetail->account_number ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="pan_number" class="form-label">PAN Number</label>
                        <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ $employee->financeDetail->pan_number ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>