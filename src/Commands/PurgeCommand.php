<?php

namespace SaeedVaziry\Monitoring\Commands;

use Exception;
use Illuminate\Console\Command;

class PurgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge old data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     *
     * @return void
     */
    public function handle()
    {
        app(config('monitoring.models.monitoring_record'))
            ->where(
                'created_at',
                '<',
                date('Y-m-d', strtotime(config('monitoring.purge_before', '-1 day')))
            )
            ->delete();
    }
}
