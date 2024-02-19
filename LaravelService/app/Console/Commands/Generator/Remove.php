<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\Command;

class Remove extends Command
{
    private array $fileNames = [
        'app/Models/CrudGenerator',
        'app/Http/Controllers/CrudGeneratorController',
        'app/Http/Requests/StoreRequest/StoreCrudGeneratorRequest',
        'app/Http/Requests/UpdateRequest/UpdateCrudGeneratorRequest',
        'app/Http/Resources/CrudGeneratorResource',
        'app/Listeners/CrudGeneratorListen',
        'app/Events/CrudGeneratorEvent',
        'app/Jobs/CrudGeneratorJob',
        'app/Services/CrudGeneratorService',
        'app/Repositories/CrudGeneratorRepository',
        'database/factories/CrudGeneratorFactory',
        'database/seeders/CrudGeneratorSeeder',
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:remove {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'KILO: CRUD Removing or Deleting Success Fully!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testMethods = ['Index', 'Store', 'Show', 'Update', 'Delete'];
        $httpMethods = ['get', 'post', 'get', 'put', 'delete'];
        $pathX = $this->argument('name');

        foreach ($this->fileNames as $fileName)
        {
            echo "KILO: " .str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php' . "\n";
            unlink(str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php');

            foreach ($testMethods as $index => $methods)
            {
                $testFileName = "tests/Feature/{$pathX}/{$httpMethods[$index]}{$pathX}{$testMethods[$index]}RequestTest.php";
                if (file_exists($testFileName))
                {
                    unlink($testFileName);
                }
            }
        }
        rmdir("tests/Feature/{$pathX}");
        die();
        $this->info($this->description);
    }
}
