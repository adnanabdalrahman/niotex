<?php

namespace App\Console\Commands;

use App\Notifications\ErrorNotifiable;
use App\Notifications\ErrorReportNotification;
use Illuminate\Console\Command;

class TestCeosInterfaceQueue extends Command
{
    protected $signature = 'test:ceosinterface-queue';
    protected $description = 'Test queue with ceosinterface database';

    public function handle()
    {
        // Test database connection
        try {
            \DB::connection('mysql')->getPdo();
            $this->info('✓ ceosinterface database connection successful');
        } catch (\Exception $e) {
            $this->error('✗ ceosinterface database connection failed: ' . $e->getMessage());
            return 1;
        }

        // Test queue
        $report = [
            "status" => "error",
            "status_code" => 422,
            "code" => "QUEUE_TEST",
            "message" => "Test queue message for ceosinterface",
            "errors" => null,
            "meta" => [
                "path" => "test/queue",
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('queue_test_', true)
            ]
        ];

        $notifiable = new ErrorNotifiable();
        $notifiable->notify(new ErrorReportNotification($report));

        $this->info('✓ Notification dispatched to queue in ceosinterface database!');
        $this->info('Run "php artisan queue:work" to process the job');

        // Show queue status
        $pendingJobs = \DB::table('jobs')->count();
        $this->info("Pending jobs in queue: {$pendingJobs}");
    }
}
