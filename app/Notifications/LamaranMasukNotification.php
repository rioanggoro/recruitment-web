<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LamaranMasukNotification extends Notification
{
    use Queueable;

    public $pelamar;

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @return void
     */
    /*******  eee94251-7939-4380-9eda-0ce5ff27cd1e  *******/
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
            'pelamar_name' => $this->pelamar->name,
            'link' => url('/admin/manage-loker')
        ];
    }
}
