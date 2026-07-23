<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MonitorCeosInterfaceQueue extends Command
{
    protected $signature = 'queue:monitor-ceos';
    protected $description = 'Monitor ceosinterface queue status';

    public function handle()
    {
        $pendingJobs = DB::connection('mysql')->table('jobs')->count();
        $failedJobs = DB::connection('mysql')->table('failed_jobs')->count();

        $this->info("ceosinterface Queue Status:");
        $this->info("==========================");
        $this->info("Pending jobs: {$pendingJobs}");
        $this->info("Failed jobs: {$failedJobs}");

        if ($failedJobs > 0) {
            $this->warn('You have failed jobs. Run: php artisan queue:failed');
        }

        if ($pendingJobs > 0) {
            $this->info('Run: php artisan queue:work to process jobs');
        }
    }
}
