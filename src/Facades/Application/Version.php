<?php

declare(strict_types=1);

namespace LaravelPay\Support\Facades\Application;

use Illuminate\Support\Facades\Facade;
use LaravelPay\Support\Application\PHPVersion as Helper;

/**
 * @method static Helper of(string $version)
 * @method static bool lt(string $version)
 * @method static bool lte(string $version)
 * @method static bool gt(string $version)
 * @method static bool gte(string $version)
 * @method static bool equalTo(string $version)
 * @method static bool notEqualTo(string $version)
 * @method static bool is(string $version, string $comparator)
 */
class Version extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Helper::class;
    }
}
