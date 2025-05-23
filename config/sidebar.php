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
            'permissions' => ['manage-users', 'manage-employees'], // Added 'manage-employees'
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
                [
                    'label' => 'Employee Add',
                    'route' => 'employees.create',
                    'permissions' => ['create-employee'],
                ],
                [
                    'label' => 'Employee List',
                    'route' => 'employees.index',
                    'permissions' => ['list-employees'],
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
        [
            'label' => 'Settings',
            'icon' => 'las la-cog',
            'permissions' => ['manage-settings'], // top-level permission
            'sub_menu' => [
                [
                    'label' => 'General Settings',
                    'route' => 'settings.general.edit',
                    'permissions' => ['view-general-settings'],
                ],
                [
                    'label' => 'Email Settings',
                    'route' => 'settings.email.edit',
                    'permissions' => ['view-email-settings'],
                ],
                [
                    'label' => 'Notification Settings',
                    'route' => 'settings.notifications.edit',
                    'permissions' => ['view-notification-settings'],
                ],
            ],
        ],
        // ... other top-level menu items
    ],
];