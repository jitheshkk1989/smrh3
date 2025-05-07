<?php

return [
    'items' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard', // Or a URL like '/'
            'icon' => 'las la-home',
            'permissions' => ['view-dashboard'], // Array of required permissions
            'sub_menu' => [
                [
                    'label' => 'New Dahsboard',
                    'route' => 'dashboard',
                    'permissions' => ['view-account-dashboard'],
                ],
            ],
        ],
        [
            'label' => 'User',
            'icon' => 'las la-user-tie',
            'permissions' => ['manage-users'],
            'sub_menu' => [
                [
                    'label' => 'User Profile',
                    'route' => 'profile',
                    'permissions' => ['view-profile'],
                ],
                [
                    'label' => 'User Edit',
                    'route' => 'profile.edit',
                    'permissions' => ['edit-profile'],
                ],
                [
                    'label' => 'User Add',
                    'route' => 'users.create',
                    'permissions' => ['create-user'],
                ],
                [
                    'label' => 'User List',
                    'route' => 'users.index',
                    'permissions' => ['list-users'],
                ],
            ],
        ],
        [
            'label' => 'Permissions',
            'icon' => 'las la-lock',
            'permissions' => ['manage-permissions'], // You might want to create this permission
            'sub_menu' => [
                [
                    'label' => 'Menu Permissions',
                    'route' => 'admin.menu-permissions.index',
                    'permissions' => ['manage-menu-permissions'], // You might want to create this permission
                ],
                // You can add more permission-related sub-menus here if needed
            ],
        ],
        [
            'label' => 'UI Elements',
            'icon' => 'lab la-elementor',
            'permissions' => ['view-ui-elements'],
            'sub_menu' => [
                [
                    'label' => 'Colors',
                    'route' => 'ui.colors',
                    'permissions' => ['view-ui-colors'],
                ],
                [
                    'label' => 'Typography',
                    'route' => 'ui.typography',
                    'permissions' => ['view-ui-typography'],
                ],
                // ... other UI elements
            ],
        ],
        // ... other top-level menu items
    ],
];