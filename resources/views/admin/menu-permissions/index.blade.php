@extends('layouts.app')

@section('content')
    <h1>Menu Permissions</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.menu-permissions.edit', $user) }}" class="btn btn-sm btn-primary">Edit Permissions</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection