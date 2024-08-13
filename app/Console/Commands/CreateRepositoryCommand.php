<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Tạo một repository mới';

    public function handle()
    {
        $name = $this->argument('name');
        $repositoryPath = app_path("Repositories/{$name}Repository.php");
        $interfacePath = app_path("Contracts/Repositories/{$name}RepositoryInterface.php");

        $this->createRepository($name, $repositoryPath);
        $this->createInterface($name, $interfacePath);

        $this->info("Repository và Interface đã được tạo thành công.");
    }

    private function createRepository($name, $path)
    {
        $content = "<?php\n\nnamespace App\\Repositories;\n\nuse App\\Contracts\\Repositories\\{$name}RepositoryInterface;\nuse App\\Models\\{$name};\n\nclass {$name}Repository extends EloquentRepository implements {$name}RepositoryInterface\n{\n    public function getModel(): string\n    {\n        return {$name}::class;\n    }\n}";

        File::put($path, $content);
    }

    private function createInterface($name, $path)
    {
        $content = "<?php\n\nnamespace App\\Contracts\\Repositories;\n\ninterface {$name}RepositoryInterface extends EloquentRepositoryInterface\n{\n}";

        File::put($path, $content);
    }
}
