<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Boilerplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:boilerplate {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create boilerplate for CRUD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // print the message
        $this->info('Creating boilerplate...');

        //if name is not set
        if (!$this->option('name')) {
            $this->error('--name option is required');
            return;
        }

        //make migration
        //split the "/" and get the last array
        $name_migration = explode('/', $this->option('name'));
        $name_migration = end($name_migration);
        $name_migration = Str::plural($name_migration);
        $this->call('make:migration', [
            'name' => 'create' . $name_migration . '_table',
        ]);

        //make model
        $this->call('make:model', [
            'name' => $this->option('name'),
        ]);

        //make the controller
        $this->call('make:controller', [
            'name' => $this->option('name') . 'Controller',
        ]);

        //make the view
        //lowercase the name
        $name_view = strtolower($this->option('name'));
        $this->call('make:view', [
            'name' => $name_view . '/index',
        ]);
        $this->call('make:view', [
            'name' => $name_view . '/create',
        ]);
        $this->call('make:view', [
            'name' => $name_view . '/detail',
        ]);

        //write the route in web.php with App\Http\Controllers\UserController::class example
        $this->info('Writing route...');
        //change / to \
        $name = str_replace('/', '\\', $this->option('name'));
        $controller = "App\Http\Controllers\\" . $name . "Controller::class";
        $route = "\nRoute::resource('" . $name_view . "', " . $controller . ");";
        file_put_contents(base_path('routes/web.php'), $route, FILE_APPEND);

        $this->info('Boilerplate created successfully.');
    }
}
