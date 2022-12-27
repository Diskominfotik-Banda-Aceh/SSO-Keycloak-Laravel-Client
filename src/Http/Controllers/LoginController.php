<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP\Http\Controllers;

class LoginController{
    public function login(){
        return view('sso-banda-aceh-php::auth');
    }
}
