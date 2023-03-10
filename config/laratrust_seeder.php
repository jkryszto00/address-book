<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'addresses' => 'c,r,u,d',
            'users' => 'c,r,u,d',
        ],
        'administrator' => [
            'addresses' => 'c,r,u,d',
            'users' => 'r,u'
        ],
        'user' => [
            'addresses' => 'c,r,u',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
