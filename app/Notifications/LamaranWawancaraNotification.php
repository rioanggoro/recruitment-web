<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Lamaran Anda untuk posisi ' . $this->jobTitle . ' masuk ke tahap wawancara.',
            'link' => url('/pelamar/lamaran')
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Undangan Wawancara')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Selamat! Lamaran Anda untuk posisi ' . $this->jobTitle . ' telah lolos ke tahap wawancara.')
            ->line('Silakan cek platform untuk detail wawancara.')
            ->action('Lihat Detail Wawancara', url('/pelamar/lamaran'))
            ->line('Hormat kami,')
            ->line('HR Anugerah Inovasi Sejahtera');
    }
}
