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
//        $request->session()->put('state', $state = Str::random(40));
//
//        $query = http_build_query([Model::class
//            'client_id' => 'sinergi-web',
//            'redirect_uri' => 'http://sinergi.test/auth/callback',
//            'response_type' => 'code',
//            'scope' => 'profile',
//            'state' => $state,
//        ]);
//
//        return redirect('https://sso.bandaacehkota.go.id/auth/realms/BandaAceh/protocol/openid-connect/auth?'.$query);

        return $this->ssoService->redirect();
    }

    public function callback(Request $request){
        try {
            $providerUser = $this->ssoService->user();
        }catch (\Exception $e){
            return redirect()->route('sso.redirect');
        }

        // $user = getUserModel()::where('email', $providerUser->getEmail())->first();

        // if (!$user)
        //     return redirect()->route('login')->withErrors('Anda tidak terdaftar pada aplikasi ini. Silahkan hubungi Admin.');

        // $this->ssoService->setUser($user);
        // $this->ssoService->updateUser($providerUser);

        // Auth::login($user, true);

        // return redirect()->route('admin.home');

        dd($providerUser);
    }

    public function logout(){
        $this->ssoService->logout();
        \auth()->logout();
    }
}
