<?php

namespace LaravelPay\Console;

class MakeExceptionCommand extends Command
{
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

        $namespace = self::NAMESPACE_PREFIX.'Exceptions';

        return (int) $this->createFileFromStub(
            output : $output,
            filePath : $path,
            className : $name,
            namespace : $namespace
        );
    }
}
