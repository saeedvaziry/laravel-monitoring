<?php

namespace SaeedVaziry\Monitoring\Commands;

use Exception;
use Illuminate\Console\Command;
use SaeedVaziry\Monitoring\Actions\CheckForAlerts;
use SaeedVaziry\Monitoring\Actions\RecordUsage;
use SaeedVaziry\Monitoring\Facades\Monitoring;

class RecordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record resources usages';

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
        tap(app(RecordUsage::class)->record([
            'cpu'    => Monitoring::cpu()->usage(),
            'memory' => Monitoring::memory()->usage(),
            'disk'   => Monitoring::disk()->usage(),
        ]), function ($record) {
            app(CheckForAlerts::class)->check($record);
        });
    }
}
