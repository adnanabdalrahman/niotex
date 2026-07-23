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
        $this->onQueue('notifications');
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        // Your existing implementation
        $message = $this->report['message'] ?? null;
        $statusCode = $this->report['status_code'] ?? null;
        $errorCode = $this->report['code'] ?? null;
        $path = $this->report['meta']['path'] ?? null;
        $traceId = $this->report['meta']['trace_id'] ?? null;
        $timestamp = $this->report['meta']['timestamp'] ?? null;
        $ip = $this->report['meta']['ip'] ?? null;
        $channel = $this->report['channel'] ?? null;
        $headers = $this->report['meta']['headers'] ?? null;
        $url = $this->report['meta']['url'] ?? null;
        $raw_body = $this->report['meta']['raw_body'] ?? null;
        $body = $this->report['meta']['body'] ?? '';
        $user_id = $this->report['meta']['user_id'] ?? null;
        $niotixToken = $this->report['meta']['headers']['x-niotix-token'][0] ?? null;
        $ceosWebToken = $this->report['meta']['headers']['ceos-web-token'][0] ?? null;

        $content = "🚨 *Error Report*\n\n";
        $content .= $message ? "*Message:* {$message}\n" : "";
        $content .= $statusCode ? "*Status Code:* {$statusCode}\n" : "";
        $content .= $errorCode ? "*Error Code:* {$errorCode}\n" : "";
        $content .= $path ? "*Path:* {$path}\n" : "";
        $content .= $channel ? "*Channel:* {$channel}\n" : "";
        $content .= $traceId ? "*Trace ID:* {$traceId}\n" : "";
        $content .= $timestamp ? "*Timestamp:* {$timestamp}\n" : "";
        $content .= $ip ? "*IP:* {$ip}\n" : "";
        $content .= $url ? "*URL:* {$url}\n" : "";
        $content .= $user_id ? "*User_id:* {$user_id}\n" : "";
        $content .= $niotixToken ? "*NiotixToken:* {$niotixToken}\n" : "";
        $content .= $ceosWebToken ? "*CeosWebToken:* {$ceosWebToken}\n" : "";


        if (!empty($this->report['errors'])) {
            $errors = is_array($this->report['errors']) ?
                json_encode($this->report['errors'], JSON_PRETTY_PRINT) :
                (string)$this->report['errors'];
            $content .= "*Errors:* \n```{$errors}```\n";
        }
        return (new SlackMessage)->text($content);
    }
}
