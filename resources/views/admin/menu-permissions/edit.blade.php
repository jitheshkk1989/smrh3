@extends('layouts.app')

@section('content')
    <h1>Edit Menu Permissions for {{ $user->name }}</h1>

    <form action="{{ route('admin.menu-permissions.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        @php
            function renderMenuItems($items, $userMenuPermissions, $prefix = '') {
                foreach ($items as $item) {
                    $key = $item['key'] ?? Str::slug($item['label']); // Fallback if key is missing
                    $enabled = $userMenuPermissions[$key] ?? true; // Default to enabled if not set
                    $label = $prefix . $item['label'];
                    @endphp
                    <div>
                        <input type="checkbox" name="{{ $key }}" id="{{ $key }}" {{ $enabled ? 'checked' : '' }}>
                        <label for="{{ $key }}">{{ $label }}</label>
                    </div>
                    @php
                    if (isset($item['sub_menu'])) {
                        renderMenuItems($item['sub_menu'], $userMenuPermissions, '- ');
                    }
                }
            }

            renderMenuItems($menuItems->whereNull('parent_key')->toArray(), $userMenuPermissions);
        @endphp

        <button type="submit" class="btn btn-primary">Update Permissions</button>
        <a href="{{ route('admin.menu-permissions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection