<?php

namespace LaravelPay\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputArgument;

class Command extends BaseCommand
{
    protected string $name;

    protected string $command;

    protected string $description;

    private string $commandName;

    private array $arguments;

    private function parseCommand(): void
    {
        $command = $this->command;
        $commandArgs = explode(' ', $command);

        $this->commandName = array_shift($commandArgs);

        $this->arguments = $commandArgs;
    }

    public function arguments(): array
    {
        $this->parseCommand();
        $commandArgs = $this->arguments;

        $arguments = [];

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

        $this->setName($this->commandName)->setDescription($this->description);

        foreach ($args as $arg => $optional) {
            if ($optional) {
                $this->addArgument($arg, InputArgument::OPTIONAL, 'The name of the '.$arg.'.');
            } else {
                $this->addArgument($arg, InputArgument::REQUIRED, 'The name of the '.$arg.'.');
            }
        }
    }
}
