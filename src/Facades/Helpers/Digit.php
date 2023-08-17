<?php

namespace LaravelPay\Support\Facades\Helpers;

use Illuminate\Support\Facades\Facade;
use LaravelPay\Support\Helpers\Digit as Helper;

/**
 * @method static bool isFalse($value)
 * @method static bool isTrue($value)
 * @method static bool to($value)
 * @method static bool|null parse($value)
 * @method static string toString(bool $value)
 */
class Digit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Helper::class;
    }
}
