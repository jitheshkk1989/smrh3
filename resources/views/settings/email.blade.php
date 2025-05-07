@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Email Settings</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <p>Configure your SMTP email settings for sending notifications and messages.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('settings.email.update') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="smtp_host">SMTP Host</label>
                        <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="{{ old('smtp_host', $settings->smtp_host) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="smtp_port">SMTP Port</label>
                        <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="{{ old('smtp_port', $settings->smtp_port) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="smtp_user">SMTP Username</label>
                        <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="{{ old('smtp_user', $settings->smtp_user) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="smtp_pass">SMTP Password</label>
                        <input type="password" class="form-control" id="smtp_pass" name="smtp_pass" value="{{ old('smtp_pass', $settings->smtp_pass) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="from_address">From Email Address</label>
                        <input type="email" class="form-control" id="from_address" name="from_address" value="{{ old('from_address', $settings->from_address) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="from_name">From Name</label>
                        <input type="text" class="form-control" id="from_name" name="from_name" value="{{ old('from_name', $settings->from_name) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="confirm_settings" required>
                        <label class="form-check-label" for="confirm_settings">
                            Confirm these settings are correct
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Save Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection
