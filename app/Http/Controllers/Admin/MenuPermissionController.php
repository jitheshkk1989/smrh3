<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMenuPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MenuPermissionController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.menu-permissions.index', compact('users'));
    }

    public function edit(User $user)
    {
        $sidebarItems = config('sidebar.items');
        $menuItems = $this->buildMenuHierarchy($sidebarItems); // Use the hierarchical builder

        $userMenuPermissions = UserMenuPermission::where('user_id', $user->id) 
            ->pluck('enabled', 'menu_item_key')
            ->toArray();
        return view('admin.menu-permissions.edit', compact('user', 'menuItems', 'userMenuPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $sidebarItems = config('sidebar.items');
        $allMenuItemsKeys = collect($this->flattenMenuKeys($sidebarItems))->filter()->toArray();
        foreach ($allMenuItemsKeys as $key) {
            UserMenuPermission::updateOrCreate(
                ['user_id' => $user->id, 'menu_item_key' => $key],
                ['enabled' => $request->has($key)]
            );
        }

        return redirect()->route('admin.menu-permissions.index')->with('success', 'Menu permissions updated for ' . $user->name); 
    }

    /**
     * Builds a hierarchical array of menu items for display.
     *
     * @param array $items
     * @return array
     */
    protected function buildMenuHierarchy(array $items): array
    {
        $menu = [];
        foreach ($items as $item) {
            $menuItem = [
                'key' => $item['key'] ?? null,
                'label' => $item['label'], // Use 'label' to match your Blade
                'url' => $item['url'] ?? null,
                'icon' => $item['icon'] ?? null,
                'sub_menu' => [],
            ];

            if (isset($item['sub_menu'])) {
                $menuItem['sub_menu'] = $this->buildMenuHierarchy($item['sub_menu']);
            }
            $menu[] = $menuItem;
        }
        return $menu;
    }

    /**
     * Flattens the menu array to extract all menu item keys.
     *
     * @param array $items
     * @return array
     */
    protected function flattenMenuKeys(array $items): array
    {
        $keys = [];
    foreach ($items as $item) {
        if (isset($item['key'])) {
            $keys[] = $item['key'];
        }
        if (isset($item['sub_menu'])) {
            $keys = array_merge($keys, $this->flattenMenuKeys($item['sub_menu']));
        }
    }
    return $keys;
    }
}