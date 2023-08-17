<?php

namespace LaravelPay\Support\Types;

use Exception;
use LaravelPay\Support\Facades\Helpers\Boolean as BooleanHelper;
use ReflectionClass;
use Throwable;

class Is
{
    /**
     * Determines if the value is empty.
     */
    public function isEmpty(mixed $value): bool
    {
        if (is_numeric($value) || is_bool($value)) {
            return false;
        }

        return empty($value) || $this->isStrEmpty($value) || $this->isArrEmpty($value);
    }

    private function isStrEmpty($value): bool
    {
        $value = is_string($value) ? trim($value) : $value;

        return empty($value) && ! is_numeric($value) && (is_string($value) || is_null($value));
    }

    private function isArrEmpty($value): bool
    {
        $value = is_object($value) && method_exists($value, 'toArray') ? $value->toArray() : $value;
        $value = is_object($value) ? (array) $value : $value;

        return is_array($value) && empty($value);
    }

    /**
     * Determines if the value is doesn't empty.
     */
    public function doesntEmpty(mixed $value): bool
    {
        return ! $this->isEmpty($value);
    }

    /**
     * Finds whether a variable is an object.
     */
    public function object(mixed $value): bool
    {
        return is_object($value);
    }

    /**
     * Find whether the type of a variable is string.
     */
    public function string(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * Determines if a value is boolean.
     */
    public function boolean(mixed $value): bool
    {
        $result = BooleanHelper::parse($value);

        return is_bool($result);
    }

    /**
     * Find whether the type of a variable is exception.
     */
    public function error(mixed $value): bool
    {
        return $value instanceof Exception || $value instanceof Throwable;
    }

    /**
     * Find whether the type of a variable is ReflectionClass.
     */
    public function reflectionClass(mixed $value): bool
    {
        return $value instanceof ReflectionClass;
    }
}
