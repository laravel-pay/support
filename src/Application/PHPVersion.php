<?php

namespace LaravelPay\Support\Application;

class PHPVersion
{
    public function __construct(
        protected ?string $version = null
    ) {
    }

    public function of(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function lt(string $version): bool
    {
        return $this->is($version, 'lt');
    }

    public function lte(string $version): bool
    {
        return $this->is($version, 'le');
    }

    public function gt(string $version): bool
    {
        return $this->is($version, 'gt');
    }

    public function gte(string $version): bool
    {
        return $this->is($version, 'ge');
    }

    public function equalTo(string $version): bool
    {
        return $this->is($version, 'eq');
    }

    public function notEqualTo(string $version): bool
    {
        return $this->is($version, 'ne');
    }

    protected function is(string $version, string $comparator): bool
    {
        return version_compare($version, $this->version, $comparator);
    }
}
