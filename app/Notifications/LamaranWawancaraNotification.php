<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LamaranWawancaraNotification extends Notification
{
    use Queueable;

    public $jobTitle;

    public function __construct($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Lamaran Anda untuk posisi ' . $this->jobTitle . ' masuk ke tahap wawancara.',
            'link' => url('/pelamar/lamaran')
        ];
    }
}
