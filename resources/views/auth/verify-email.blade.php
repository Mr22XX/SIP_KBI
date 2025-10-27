<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-green-700">SIP-KBI</h1>
        <p class="text-gray-600">Sistem Informasi Pengelolaan Keuangan dan Hasil Budidaya Ikan</p>
    </div>

    <div class="mb-4 text-sm text-gray-700 text-center">
        {{ __('Terima kasih telah mendaftar di SIP-KBI! 🎉') }}<br>
        {{ __('Sebelum melanjutkan, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.') }}<br>
        {{ __('Jika Anda belum menerima email, Anda dapat meminta kami mengirimkannya kembali.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-green-600 text-center bg-green-100 py-2 rounded-lg">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran. 📧') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col items-center space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button class="bg-green-600 m-1 hover:bg-green-700">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>

    <footer class="mt-10 text-center text-xs text-gray-500">
        © {{ date('Y') }} SIP-KBI. Semua Hak Dilindungi.
    </footer>
</x-guest-layout>
