<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP\Http\Controllers;

use DiskominfotikBandaAceh\SSOBandaAcehPHP\Services\SSOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SSOController
{
    private $ssoService;

    public function __construct(SSOService $SSOService)
    {
        $this->ssoService = $SSOService;
    }

    public function redirect(Request $request){
        return $this->ssoService->redirect();
    }

    public function callback(Request $request){
        try {
            $providerUser = $this->ssoService->user();
        }catch (\Exception $e){
            return redirect()->route('sso.redirect');
        }

        $user = getUserModel()::where('email', $providerUser->getEmail())->first();

        if (!$user)
            return redirect()->route('login')->withErrors('Anda tidak terdaftar pada aplikasi ini. Silahkan hubungi Admin.');

        $this->ssoService->setUser($user);
        $this->ssoService->updateUser($providerUser);

        Auth::login($user, true);

        return redirect()->route(redirectAfterLogin());
    }

    public function logout(){
        $this->ssoService->logout();
        \auth()->logout();
    }
}
