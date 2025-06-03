<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StatusLamaranUpdated extends Notification
{
    public $status;
    public $jobTitle;
    public $linkWawancara;

    public function __construct($status, $jobTitle, $linkWawancara = null)
    {
        $this->status = $status;
        $this->jobTitle = $jobTitle;
        $this->linkWawancara = $linkWawancara;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = new MailMessage;
        $message->subject('Status Lamaran Anda Diperbarui');

        if ($this->status === 'ditolak') {
            $message->line("Mohon maaf, lamaran Anda untuk posisi {$this->jobTitle} tidak diterima.");
        } elseif ($this->status === 'wawancara') {
            $message->line("Selamat! Anda masuk ke tahap wawancara untuk posisi {$this->jobTitle}.");
            if ($this->linkWawancara) {
                $message->action('Join Wawancara', $this->linkWawancara);
            }
        } elseif ($this->status === 'diterima') {
            $message->line("Selamat! Anda diterima untuk posisi {$this->jobTitle}.");
        }

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Status lamaran Anda untuk posisi {$this->jobTitle} telah berubah menjadi {$this->status}.",
        ];
    }
}
