<?php
use App\User;

return [
    'models' => [
        // set model user class
        'users' => User::class
    ],
    'redirect_after_login' => 'admin.home',
    'auth' => [
        'employee' => true,
        'society' => false,
        'developer' => false
    ]
];
