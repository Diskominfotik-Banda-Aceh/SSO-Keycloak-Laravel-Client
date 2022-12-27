<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Keycloak\KeycloakExtendSocialite::class.'@handle',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}