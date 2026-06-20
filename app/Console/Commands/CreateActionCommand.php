<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateActionCommand extends Command
{
    /**
     * The console command name.
     */
    protected $name = 'make:action';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Action class';

    /**
     * The type of class being generated.
     */
    protected $type = 'Action';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('stubs/action.stub');
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        return str_replace(
            '{{ actionVariable }}',
            lcfirst(class_basename($name)),
            $stub
        );
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the action'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
        ];
    }
}
