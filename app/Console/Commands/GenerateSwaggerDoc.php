<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSwaggerDoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera o arquivo JSON da documentação Swagger';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $outputPath = public_path('swagger.json'); // Caminho onde o JSON será salvo
        $swagger = \OpenApi\Generator::scan([app_path('Http/Controllers')]);
        file_put_contents($outputPath, $swagger->toJson());

        $this->info('Documentação gerada com sucesso em: ' . $outputPath);
    }
}
