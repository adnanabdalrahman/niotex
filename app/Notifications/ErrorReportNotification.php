<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class ErrorReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    // Optional: Customize queue settings
    public int $tries = 3;
    public int $timeout = 60;
    public array $backoff = [10, 30, 60];

    protected array $report;

    public function __construct(array $report)
    {
        $this->report = $report;
        $this->onQueue('notifications'); // Optional: specific queue name
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        // Your existing implementation
        $message = $this->report['message'] ?? 'No message';
        $statusCode = $this->report['status_code'] ?? 'N/A';
        $errorCode = $this->report['code'] ?? 'N/A';
        $path = $this->report['meta']['path'] ?? 'N/A';
        $traceId = $this->report['meta']['trace_id'] ?? 'N/A';
        $timestamp = $this->report['meta']['timestamp'] ?? 'N/A';

        $content = "🚨 *Error Report*\n\n";
        $content .= "*Message:* {$message}\n";
        $content .= "*Status Code:* {$statusCode}\n";
        $content .= "*Error Code:* {$errorCode}\n";
        $content .= "*Path:* {$path}\n";
        $content .= "*Trace ID:* {$traceId}\n";
        $content .= "*Timestamp:* {$timestamp}\n";

        if (!empty($this->report['errors'])) {
            $errors = is_array($this->report['errors']) ?
                json_encode($this->report['errors'], JSON_PRETTY_PRINT) :
                (string)$this->report['errors'];
            $content .= "*Errors:* \n```{$errors}```\n";
        }

        return (new SlackMessage)->text($content);
    }
}
