@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Menu Permissions for <span class="font-weight-bold">{{ $user->name }}</span></h1>

        <form action="{{ route('admin.menu-permissions.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mt-3">
                <div class="card-body">
                    <ul class="list-unstyled">
                        @php
                            function renderBeautifulMenuItems($items, $userMenuPermissions, $level = 0) {
                                foreach ($items as $item) {
                                    $key = $item['key'] ?? Str::slug($item['label']);
                                    // Check if the user has permission for this menu item
                                    $hasPermission = isset($userMenuPermissions[$key]) && $userMenuPermissions[$key]; 
                                    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                                    @endphp
                                    <li class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="{{ $key }}" id="{{ $key }}" {{ $hasPermission ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $key }}">
                                                {!! $indent !!}
                                                @if ($level > 0) <i class="fas fa-caret-right mr-1 text-muted"></i> @endif
                                                {{ $item['label'] }}
                                            </label>
                                        </div>
                                        @if (isset($item['sub_menu']))
                                            <ul class="list-unstyled ml-3">
                                                @php
                                                    renderBeautifulMenuItems($item['sub_menu'], $userMenuPermissions, $level + 1);
                                                @endphp
                                            </ul>
                                        @endif
                                    </li>
                                    @php
                                }
                            }

                            renderBeautifulMenuItems($menuItems, $userMenuPermissions);
                        @endphp
                    </ul>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                    <a href="{{ route('admin.menu-permissions.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection

<style>
    .form-check-input {
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
    }
</style>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBVFoVuAncKZY4w9vlkDyPwiMn+oxxiwUHwCjv+Vm6jyy39gxKR0PBj4yrPiwln1iuYpkcIw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush