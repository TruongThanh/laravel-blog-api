<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service class in app/Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $name = str_replace('\\', '/', $name);

        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        $className = class_basename($name);
        $namespace = 'App\\Services\\' . str_replace('/', '\\', dirname($name));

        $stub = <<<PHP
            <?php

            namespace {$namespace};

            class {$className}
            {
                public function __construct()
                {
                    // Initialize your service
                }
            }

            PHP;

        File::put($path, $stub);

        $this->info("Service {$className} created successfully at: {$path}");
    }
}
