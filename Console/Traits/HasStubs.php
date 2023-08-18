<?php

namespace LaravelPay\Console\Traits;

trait HasStubs
{
    protected string $stub;

    public function getStubSourceFile(): string
    {
        return __DIR__.'/../../stubs/'.$this->stub.'.stub';
    }

    private function getStubVars()
    {
        $stub = file_get_contents($this->getStubSourceFile());
        preg_match_all('/{{\s*(\w+)\s*}}/', $stub, $matches);

        return $matches[1];
    }

    public function basePath()
    {
        return __DIR__.'/../../src/';
    }

    public function createFileFromStub($output, $filePath, $className, $namespace, ...$otherArguments): bool
    {
        $path = $this->basePath().$filePath;

        if (file_exists($path)) {
            $output->writeln('<error>File already exists!</error>');

            return false;
        }

        $stubVars = $this->getStubVars();

        $keys = ['class', 'namespace'];
        $values = [$className, $namespace];

        $otherKeys = array_keys($otherArguments);
        $otherValues = array_values($otherArguments);

        $allArguments = array_merge($keys, $otherKeys);
        $allValues = array_merge($values, $otherValues);

        // get missing stub vars
        $missingVars = array_diff($stubVars, $allArguments);

        if (count($missingVars) > 0) {
            $output->writeln('<error>Missing arguments: '.implode(', ', $missingVars).'</error>');

            return false;
        }

        $stub = $this->stubReplace(file_get_contents($this->getStubSourceFile()), $allArguments, $allValues);

        file_put_contents($path, $stub);
        $output->writeln('<info>File created successfully.</info>');

        return true;
    }

    private function stubReplace($stub, $keys, $values)
    {
        $keys = array_map(function ($key) {
            return '{{ '.$key.' }}';
        }, $keys);

        return str_replace($keys, $values, $stub);
    }
}
