<?php

namespace Baraear\ThailandJS;

use Illuminate\Support\Facades\Facade;

class ThailandJSFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ThailandJS';
    }
}
