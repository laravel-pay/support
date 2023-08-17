<?php

namespace LaravelPay\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelPay\Support\Support
 */
class Support extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelPay\Support\Support::class;
    }
}
