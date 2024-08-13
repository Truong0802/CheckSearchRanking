<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Tạo một service mới';

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}Service.php");
        $interfacePath = app_path("Contracts/Services/{$name}ServiceInterface.php");

        $this->createService($name, $servicePath);
        $this->createInterface($name, $interfacePath);

        $this->info("Service và Interface đã được tạo thành công.");
    }

    private function createService($name, $path)
    {
        $content = "<?php\n\nnamespace App\\Services;\n\nuse App\\Contracts\\Services\\{$name}ServiceInterface;\n\nclass {$name}Service implements {$name}ServiceInterface\n{\n    // Thêm các phương thức của service ở đây\n}";

        File::put($path, $content);
    }

    private function createInterface($name, $path)
    {
        $content = "<?php\n\nnamespace App\\Contracts\\Services;\n\ninterface {$name}ServiceInterface\n{\n    // Định nghĩa các phương thức của interface ở đây\n}";

        File::put($path, $content);
    }
}
