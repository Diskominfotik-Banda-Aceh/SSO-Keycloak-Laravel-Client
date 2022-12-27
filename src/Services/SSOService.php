<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class SSOService
{
    const SSO_GET_USER_DETAIL = 'SSO_GET_USER_DETAIL';

    private $user;
    private $providerDriver = 'keycloak';
    private $cache = [
        self::SSO_GET_USER_DETAIL => 'ssoService.getUserDetail'
    ];

    public function redirect(){
        return Socialite::driver($this->providerDriver)->redirect();
    }

    public function user(){
        $user = null;

        try{
            $user = Socialite::driver($this->providerDriver)->user();
        }catch (\Exception $e){
            throw $e;
        }

        return $user;
    }

    public static function mapUserDetail($user):bool
    {
        $ssoService = new SSOService();
        $ssoService->setUser($user);

        $userDetail = $ssoService->getUserDetail();

        if (!$userDetail)
            return false;

        $ssoService->user->name = $userDetail->getName();

        return true;
    }

    public function getUserDetail(){
        $user = Cache::remember($this->cache[self::SSO_GET_USER_DETAIL] . $this->user->id, 60*5, function (){
            $refreshAccessToken = false;

            do{
                try{
                    return Socialite::driver('keycloak')->userFromToken($this->user->provider_token);
                }catch (\Exception $e){
                    if ($refreshAccessToken)
                        break;

                    $this->refreshAccessToken();
                    $refreshAccessToken = true;
                }
            }while(true);

            return null;
        });

        if (!$user)
            Cache::forget($this->cache[self::SSO_GET_USER_DETAIL]);

        return $user;
    }

    protected function refreshAccessToken(){
        $response = Http::asForm()->post($this->getTokenUrl(), [
            'grant_type' => 'refresh',
            'client_id' => $this->getConfig('client_id'),
            'refresh_token' => $this->user->provider_refresh_token
        ]);

        $this->user->update([
            'provider_token' => $response->json('access_token')
        ]);

        return true;
    }

    protected function revokeAccessToken(){
        $response = Http::asForm()->post($this->getRevokeTokenUrl(), [
            'token_type_hint' => 'access_token',
            'client_id' => $this->getConfig('client_id'),
            'token' => $this->user->provider_token
        ]);

        $this->user->update([
            'provider_token' => null,
            'provider_token_expired_at' => null,
            'provider_refresh_token' => null,
            'provider_refresh_token_expired_at' => null,
        ]);

        return true;
    }

    public function updateUser($data){
        $this->user->update([
            'provider_id' => $data->id,
            'provider_name' => $this->providerDriver,
            'provider_token' => $data->token,
            'provider_token_expired_at' => Carbon::now()->addSeconds($data->accessTokenResponseBody['expires_in']),
            'provider_refresh_token' => $data->refreshToken,
            'provider_refresh_token_expired_at' => Carbon::now()->addSeconds($data->accessTokenResponseBody['refresh_expires_in']),
        ]);
    }

    public function logout(){
        $this->revokeAccessToken();
    }

    public function setUser($user):void
    {
        $this->user = $user;
    }

    protected function getBaseUrl()
    {
        return rtrim(rtrim($this->getConfig('base_url'), '/').'/realms/'.$this->getConfig('realms', 'master'), '/');
    }

    protected function getConfig($key, $defaultValue=null){
        return config('services.keycloak.' . $key, $defaultValue);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->getBaseUrl().'/protocol/openid-connect/token';
    }

    protected function getRevokeTokenUrl()
    {
        return $this->getBaseUrl().'/protocol/openid-connect/revoke';
    }

    public function getProfileUrl(){
        return $this->getBaseUrl().$this->getConfig('profile_url');
    }
}
