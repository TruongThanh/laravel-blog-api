<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service class in app/Repositories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $name = str_replace('\\', '/', $name);

        $path = app_path("Repositories/{$name}.php");

        if (File::exists($path)) {
            $this->error("Repository {$name} already exists!");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        $className = class_basename($name);
        $namespace = 'App\\Repositories\\' . str_replace('/', '\\', dirname($name));

        $stub = <<<PHP
            <?php

            namespace {$namespace};

            class {$className}
            {
                public function __construct()
                {
                }
            }

        PHP;

        File::put($path, $stub);

        $this->info("Repository {$name} created successfully at: {$path}");
    }
}
