<?php

if (! function_exists('getUserModel')) {
    function getUserModel()
    {
        return config('sso-banda-aceh.models.users');
    }
}

if (! function_exists('redirectAfterLogin')) {
    function redirectAfterLogin()
    {
        return config('sso-banda-aceh.redirect_after_login');
    }
}