<?php

namespace LaravelPay\Support\Facades\Types;

use Illuminate\Support\Facades\Facade;
use LaravelPay\Support\Types\Is as Helper;

/**
 * @method static bool isFalse($value)
 * @method static bool isTrue($value)
 * @method static bool to($value)
 * @method static bool|null parse($value)
 * @method static string toString(bool $value)
 */
class Is extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Helper::class;
    }
}
