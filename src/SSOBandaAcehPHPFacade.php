<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DiskominfotikBandaAceh\SSOBandaAcehPHP\Skeleton\SkeletonClass
 */
class SSOBandaAcehPHPFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sso-banda-aceh-php';
    }
}
