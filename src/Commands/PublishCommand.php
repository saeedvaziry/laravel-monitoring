<?php

namespace SaeedVaziry\Monitoring\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'monitoring-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'monitoring-assets',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'monitoring-migrations',
            '--force' => $this->option('force'),
        ]);
    }
}
