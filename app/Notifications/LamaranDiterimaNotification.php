<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LamaranDiterimaNotification extends Notification
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
            'message' => 'Selamat! Lamaran Anda untuk posisi ' . $this->jobTitle . ' telah diterima.',
            'link' => url('/pelamar/lamaran')
        ];
    }
}
