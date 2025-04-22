<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMenuPermission; // Correct import statement
use Illuminate\Http\Request;
use Illuminate\Support\Collection; // Import the Collection class

class MenuPermissionController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.menu-permissions.index', compact('users'));
    }

    public function edit(User $user)
    {
        $menuItems = collect(config('sidebar.items'))->flatMap(function ($item) {
            $items = collect([$item]); // Initialize $items as a Collection
            if (isset($item['sub_menu'])) {
                $items = $items->merge($item['sub_menu']);
            }
            return $items;
        });

        $userMenuPermissions = UserMenuPermission::where('user_id', $user->id)
            ->pluck('enabled', 'menu_item_key')
            ->toArray();

        return view('admin.menu-permissions.edit', compact('user', 'menuItems', 'userMenuPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $menuItems = collect(config('sidebar.items'))->flatMap(function ($item) {
            $items = collect([$item]); // Initialize $items as a Collection
            if (isset($item['sub_menu'])) {
                $items = $items->merge($item['sub_menu']);
            }
            return $items;
        })->pluck('key')->filter()->toArray();

        foreach ($menuItems as $key) {
            UserMenuPermission::updateOrCreate(
                ['user_id' => $user->id, 'menu_item_key' => $key],
                ['enabled' => $request->has($key)]
            );
        }

        return redirect()->route('admin.menu-permissions.index')->with('success', 'Menu permissions updated for ' . $user->name);
    }
}