<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'blogs' => 'c,r,u,d',
            'tags' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'messages' => 'c,r,u,d',
            'teams' => 'c,r,u,d',
            'services' => 'c,r,u,d',
            'projects' => 'c,r,u,d',
            'notifications' => 'c,r,u,d',
            'employee_registrations' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
