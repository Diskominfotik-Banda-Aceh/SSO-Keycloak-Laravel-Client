<?php

if (! function_exists('getUserModel')) {
    function getUserModel()
    {
        return config('sso-banda-aceh.models.users');
    }
}
