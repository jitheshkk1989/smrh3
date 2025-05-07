@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-[#722257]">General Settings</h2>

    <form action="{{ route('settings.general.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Company Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" id="company_name" name="company_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ old('company_name', $settings->company_name ?? '') }}">
            </div>

            <div>
                <label for="company_logo" class="block text-sm font-medium text-gray-700">Company Logo</label>
                <input type="file" id="company_logo" name="company_logo" class="mt-1 block w-full">
                @if(isset($settings->company_logo))
                    <img src="{{ asset('storage/'.$settings->company_logo) }}" alt="Logo" class="h-12 mt-2">
                @endif
            </div>

            <div class="col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Company Address</label>
                <textarea id="address" name="address" class="mt-1 block w-full border border-gray-300 rounded-md p-2" rows="3">{{ old('address', $settings->address ?? '') }}</textarea>
            </div>
        </div>

        {{-- Timezone & Currency --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="time_zone" class="block text-sm font-medium text-gray-700">Time Zone</label>
                <select id="time_zone" name="time_zone" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @foreach(timezone_identifiers_list() as $tz)
                        <option value="{{ $tz }}" {{ old('time_zone', $settings->time_zone ?? '') == $tz ? 'selected' : '' }}>{{ $tz }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <input type="text" id="currency" name="currency" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ old('currency', $settings->currency ?? '') }}">
            </div>
        </div>

        {{-- Fiscal Year & Date Format --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="fiscal_year" class="block text-sm font-medium text-gray-700">Fiscal Year Start (YYYY-MM-DD)</label>
                <input type="date" id="fiscal_year" name="fiscal_year" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ old('fiscal_year', $settings->fiscal_year ?? '') }}">
            </div>

            <div>
                <label for="date_format" class="block text-sm font-medium text-gray-700">Date Format</label>
                <select id="date_format" name="date_format" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="Y-m-d" {{ old('date_format', $settings->date_format ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                    <option value="d-m-Y" {{ old('date_format', $settings->date_format ?? '') == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY</option>
                    <option value="m/d/Y" {{ old('date_format', $settings->date_format ?? '') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                </select>
            </div>
        </div>

        {{-- Working Days & Holidays --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Working Days</label>
            <div class="flex flex-wrap gap-2">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="working_days[]" value="{{ $day }}"
                            {{ in_array($day, old('working_days', json_decode($settings->working_days ?? '[]'))) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $day }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <label for="holidays" class="block text-sm font-medium text-gray-700">Holidays (Comma-separated dates)</label>
            <input type="text" id="holidays" name="holidays" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="2025-01-01,2025-08-15" value="{{ old('holidays', $settings->holidays ?? '') }}">
        </div>

        {{-- Submit Button --}}
        <div class="text-right">
            <button type="submit" class="bg-[#722257] text-white px-6 py-2 rounded-lg hover:bg-[#5a1b44]">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
