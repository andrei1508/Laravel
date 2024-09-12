<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogCustomMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:custom-message {message?} {--uppercase} {--log-type=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logs your message into into Laravel logs.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $message = $this->argument('message') ?? "Generic text.";

        if($this->option('uppercase')) {
            $message = strtoupper($message);
        }

        $logType = 0;
        if($this->option('log-type')) {
            $logType = strtoupper('log-type');
        }

        switch($logType) {
            case 0:
                Log::info($message);
                break;
            case 1:
                Log::emergency($message);
                break;
            case 2:
                Log::info($message);
                break;
            default: Log::debug($message);  
        }       

        Log::info($message);
        //Log::danger();
        //Log::debug();
        // emergency, alert, critical, error, warning, notice, info, and debug

        $this->info('Command was executed successfully.');

        return Command::SUCCESS;
    }
}



