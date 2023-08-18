<?php

namespace LaravelPay\Console;

use LaravelPay\Console\Traits\HasStubs;

class MakeExceptionCommand extends Command
{
    use HasStubs;

    protected string $command = 'make:exception name';

    protected string $description = 'Create exception class';

    protected string $stub = 'exception';

    protected function execute($input, $output): int
    {
        $name = $input->getArgument('name');

        if (! str_ends_with($name, 'Exception')) {
            $name .= 'Exception';
        }

        $path = 'Exceptions/'.ucfirst($name).'.php';

        $namespace = 'Exceptions';

        $this->createFileFromStub(
            output : $output,
            filePath : $path,
            className : $name,
            namespace : $namespace
        );

        return 0;
    }
}
