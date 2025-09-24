<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class SlackErrorReport extends Notification
{
    protected array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        // Build raw Block Kit JSON
        $blocks = [
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => '🚨 API Error Report',
                ],
            ],
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Status:*\n{$this->payload['status']}",
                    ],
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Status Code:*\n{$this->payload['status_code']}",
                    ],
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Code:*\n{$this->payload['code']}",
                    ],
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Message:*\n{$this->payload['message']}",
                    ],
                ],
            ],
        ];

        // Add errors if present
        if (!empty($this->payload['errors'])) {
            $errorsText = "";
            foreach ($this->payload['errors'] as $key => $error) {
                $errorsText .= "- {$key}: {$error}\n";
            }
            $blocks[] = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*Errors:*\n{$errorsText}",
                ],
            ];
        }

        // Add meta
        if (!empty($this->payload['meta'])) {
            $metaText = "";
            foreach ($this->payload['meta'] as $key => $value) {
                $metaText .= "- {$key}: {$value}\n";
            }
            $blocks[] = [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*Meta:*\n{$metaText}",
                ],
            ];
        }

        return new SlackMessage([
            'blocks' => $blocks, // Must be top-level
        ]);
    }
}
