<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Selamat! Anda diterima untuk posisi ' . $this->jobTitle . '.',
            'link' => url('/pelamar/lamaran'),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Lamaran Anda Diterima')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Selamat! Lamaran Anda untuk posisi ' . $this->jobTitle . ' telah diterima.')
            ->line('Kami akan segera menghubungi Anda untuk proses selanjutnya.')
            ->action('Lihat Status Lamaran', url('/pelamar/lamaran'))
            ->line('Hormat kami,')
            ->line('HR Anugerah Inovasi Sejahtera');
    }
}
