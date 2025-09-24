<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class ErrorNotifiable
{
    use Notifiable;

    private string $email;

    public function __construct()
    {
        $this->email = 'adnan@ceos-software.de';
    }

    /**
     * Get the notification routing information for the given driver.
     *
     * @param string $driver
     * @param Notification|null $notification
     * @return mixed
     */
    public function routeNotificationFor($driver, $notification = null): mixed
    {
        if (method_exists($this, $method = 'routeNotificationFor' . ucfirst($driver))) {
            return $this->{$method}($notification);
        }

        return match ($driver) {
            'database' => $this->notifications(),
            'mail' => $this->email,
            'slack' => $this->routeNotificationForSlack(),
            default => null,
        };
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @return string
     */
    public function routeNotificationForSlack(): string
    {
        return config('services.slack.notifications.channel');
    }
}
