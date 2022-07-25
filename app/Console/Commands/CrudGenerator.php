<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;

class CrudGenerator extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a CRUD for the given model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CRUD';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $repositoryClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $crud;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function hand(){

        $this->setRepositoryClass();

        $path = $this->getPath($this->repositoryClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->repositoryClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Crud Generated Successfully :</info> $this->repositoryClass");
    }

    // /**
    //  * Set repository class name
    //  *
    //  * @return  void
    //  */
    private function setCrudName()
    {
        $this->crud = ucwords(strtolower($this->argument('name')));
    }

    // /**
    //  * Replace the class name for the given stub.
    //  *
    //  * @param  string  $stub
    //  * @param  string  $name
    //  * @return string
    //  */
    // protected function replaceClass($stub, $name)
    // {
    //     if(!$this->argument('name')){
    //         throw new InvalidArgumentException("Missing required argument model name");
    //     }

    //     $stub = parent::replaceClass($stub, $name);

    //     return str_replace('DummyModel', $this->model, $stub);
    // }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path('stubs/Repository.stub');
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repo';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the crud function.'],
        ];
    }
}
