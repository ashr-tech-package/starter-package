<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Auth Base URL
    |--------------------------------------------------------------------------
    |
    | Set the base URL used on the Auth Service Layer.
    |
    */

    'auth_base_url' => env('AUTH_BASE_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Access User Path
    |--------------------------------------------------------------------------
    |
    | Set url used on check access user
    |
    */
    'access_user_path' => env('ACCESS_USER_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | Refresh Token Path
    |--------------------------------------------------------------------------
    |
    | Set url used on refresh token user
    |
    */
    'refresh_token_path' => env('REFRESH_TOKEN_PATH', ''),
];