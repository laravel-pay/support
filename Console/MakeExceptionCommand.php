<?php

namespace LaravelPay\Console;

class MakeExceptionCommand extends Command
{
    protected string $command = 'make:exception name';

    protected string $description = 'Create exception class';

    protected function execute($input, $output): int
    {
        $name = $input->getArgument('name');
        $name = ucfirst($name);

        if (! str_ends_with($name, 'Exception')) {
            $name .= 'Exception';
        }

        $path = $this->getPackagePath('Exceptions/'.$name.'.php');

        $namespace = self::NAMESPACE_PREFIX.'Exceptions';
        $stub = 'exception';

        $this->createFileFromStub($output, $stub, $path, $name, $namespace);

        return 0;
    }
}
