<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os comandos Artisan fornecidos pelo aplicativo.
     */
    protected $commands = [
        \App\Console\Commands\GenerateSwaggerDoc::class, // Registra o comando Swagger
    ];

    /**
     * Define o agendamento de comandos Artisan.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Exemplo: $schedule->command('inspire')->hourly();
    }

    /**
     * Registra os comandos no console do Artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
