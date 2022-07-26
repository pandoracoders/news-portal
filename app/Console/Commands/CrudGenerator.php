<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD controller and model and request';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:model', ['name' => $this->argument('name') , "--migration" => true]);
        $this->call('make:request', ['name' => $this->argument('name') . 'Request']);
        $this->call('make:controller', ['name' => $this->argument('name') . 'Controller' , "--resource" => true]);

        // $this->call('make:view', ['name' => $this->argument('name') . 'Form']);

    }
}
