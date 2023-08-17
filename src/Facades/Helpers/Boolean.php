<?php

namespace LaravelPay\Support\Facades\Helpers;

use Illuminate\Support\Facades\Facade;
use LaravelPay\Support\Helpers\Boolean as Helper;

/**
 * @method static bool isFalse($value)
 * @method static bool isTrue($value)
 * @method static bool to($value)
 * @method static bool|null parse($value)
 * @method static string toString(bool $value)
 */
class Boolean extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Helper::class;
    }
}
