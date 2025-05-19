<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LamaranMasukNotification extends Notification
{
    use Queueable;

    public $pelamar;

    public function __construct($pelamar)
    {
        $this->pelamar = $pelamar;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Lamaran baru dari ' . $this->pelamar->name,
            'link' => url('/admin/detail-loker')

        ];
    }
}
