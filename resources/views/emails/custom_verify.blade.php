@component('mail::message')


# Halo, {{ $notifiable->username ?? $notifiable->name }} 👋

Terima kasih telah bergabung dengan **SIP-KBI**.  
Klik tombol di bawah ini untuk memverifikasi akun Anda.

@component('mail::button', ['url' => $actionUrl])
Verifikasi Sekarang
@endcomponent

Jika Anda tidak merasa mendaftar, abaikan email ini.

Salam hangat,  
**Tim SIP-KBI**
@endcomponent
