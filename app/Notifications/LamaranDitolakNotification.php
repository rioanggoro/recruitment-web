<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LamaranDitolakNotification extends Notification
{
    use Queueable;

    protected $jobTitle;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification for database.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => "Lamaran Anda untuk posisi {$this->jobTitle} ditolak.",
            'link'    => url('/pelamar/lamaran'),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Lamaran Anda Ditolak')
            ->greeting("Halo {$notifiable->name},")
            ->line("Terima kasih telah melamar di PT Anugerah Inovasi Sejahteras.")
            ->line("Kami mohon maaf, lamaran Anda untuk posisi **{$this->jobTitle}** tidak dapat kami lanjutkan ke tahap berikutnya.")
            ->line('Semoga sukses untuk kesempatan Anda yang lain di masa depan.')
            ->action('Lihat Status Lamaran', url('/pelamar/lamaran'))
            ->salutation('Salam hormat, HR Anugerah Inovasi Sejahtera');
    }
}
