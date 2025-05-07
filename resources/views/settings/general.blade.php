@extends('layouts.app')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">General Settings</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <form action="{{ route('settings.general.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Company Details --}}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $settings->company_name ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="company_logo">Company Logo</label>
                    <input type="file" class="form-control" id="company_logo" name="company_logo">
                    @if(isset($settings->company_logo))
                        <img src="{{ asset('storage/'.$settings->company_logo) }}" alt="Logo" class="mt-2" height="50">
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label for="address">Company Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $settings->address ?? '') }}</textarea>
                </div>
            </div>

            {{-- Time Zone and Currency --}}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="time_zone">Time Zone</label>
                    <select class="form-control" id="time_zone" name="time_zone">
                        @foreach(timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}" {{ old('time_zone', $settings->time_zone ?? '') == $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control" id="currency" name="currency" value="{{ old('currency', $settings->currency ?? '') }}">
                </div>
            </div>

            {{-- Fiscal Year & Date Format --}}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="fiscal_year">Fiscal Year Start</label>
                    <input type="date" class="form-control" id="fiscal_year" name="fiscal_year" value="{{ old('fiscal_year', $settings->fiscal_year ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date_format">Date Format</label>
                    <select class="form-control" id="date_format" name="date_format">
                        <option value="Y-m-d" {{ old('date_format', $settings->date_format ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                        <option value="d-m-Y" {{ old('date_format', $settings->date_format ?? '') == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY</option>
                        <option value="m/d/Y" {{ old('date_format', $settings->date_format ?? '') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                    </select>
                </div>
            </div>

            {{-- Working Days --}}
            <div class="form-group">
                <label class="mb-2 d-block">Working Days</label>
                @php
                    $workingDays = old('working_days', $settings->working_days ?? '[]');
                @endphp
                <div class="form-check form-check-inline">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="working_days[]" id="day_{{ $day }}" value="{{ $day }}"
                                {{ in_array($day, $workingDays) ? 'checked' : '' }}>
                            <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Holidays --}}
            <div class="form-group">
                <label for="holidays">Holidays (comma-separated)</label>
                <input type="text" class="form-control" id="holidays" name="holidays" value="{{ old('holidays', $settings->holidays ?? '') }}" placeholder="2025-01-01,2025-08-15">
            </div>

            {{-- Submit --}}
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
