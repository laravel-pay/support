<?php

namespace LaravelPay\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputArgument;

class Command extends BaseCommand
{
    public const NAMESPACE_PREFIX = 'LaravelPay\\Support\\';

    protected string $name;

    protected string $command;

    protected string $description;

    public function arguments(): array
    {
        $command = $this->command;

        $arguments = [];

        $commandArgs = explode(' ', $command);

        foreach ($commandArgs as $arg) {
            if (strpos($arg, '?') !== false) {
                $arg = str_replace('?', '', $arg);
                $arguments[$arg] = true;
            } else {
                $arguments[$arg] = false;
            }
        }

        return $arguments;
    }

    protected function configure(): void
    {
        $args = $this->arguments();
        $name_key = array_key_first($args);
        $name = $args[$name_key];

        $this->setName($name_key)
            ->setDescription($this->description);

        unset($args[$name_key]);

        foreach ($args as $arg => $optional) {
            if ($optional) {
                $this->addArgument($arg, InputArgument::OPTIONAL, 'The name of the '.$arg.'.');
            } else {
                $this->addArgument($arg, InputArgument::REQUIRED, 'The name of the '.$arg.'.');
            }
        }
    }

    public function createFileFromStub($output, $stub, $path, $name, $namespace, $otherArguments = []): bool
    {
        if (file_exists($path)) {
            $output->writeln('<error>Exception already exists!</error>');

            return false;
        }

        $stub = str_replace(
            ['{{name}}', '{{namespace}}'],
            [$name, $namespace],
            file_get_contents(__DIR__.'/../stubs/'.$stub.'.stub')
        );

        foreach ($otherArguments as $key => $value) {
            $stub = str_replace(
                ['{{'.$key.'}}'],
                [$value],
                $stub
            );
        }

        file_put_contents($path, $stub);
        $output->writeln('<info>Exception created successfully.</info>');

        return true;
    }

    public function getPackagePath($path)
    {
        return "__DIR__.'/../src/$path";
    }
}
