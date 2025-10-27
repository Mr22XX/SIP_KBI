<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class CustomVerifyEmail extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Buat signed verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage)
            ->subject('Verifikasi Akun Anda di SIP-KBI')
            ->greeting('Halo, ' . ($notifiable->name ?? $notifiable->username) . ' 👋')
            ->line('Terima kasih telah mendaftar di SIP-KBI.')
            ->line('Klik tombol di bawah untuk memverifikasi email Anda.')
            ->action('Verifikasi Sekarang', $verificationUrl)
            ->line('Jika Anda tidak merasa mendaftar, abaikan email ini.')
            // Pastikan kita kirim juga variabel ke view agar blade dapat memakai $notifiable dan $actionUrl
            ->markdown('emails.custom_verify', [
                'notifiable' => $notifiable,
                'actionUrl'  => $verificationUrl,
            ]);
    }
}
