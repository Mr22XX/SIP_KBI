<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-KBI | Sistem Informasi Pengelolaan Ikan</title>

    <!-- ✅ Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Konfigurasi warna SIP-KBI -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>

    <style>
        /* Transisi lembut antar gambar */
        .fade-bg {
            transition: opacity 1s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-500">

    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 relative z-10">
        <div class="flex items-center space-x-3">
            <!-- <img src="{{ asset('images/logo-sipkbi.png') }}" alt="Logo SIP-KBI" class="w-10 h-10"> -->
            <h1 class="text-2xl font-bold text-sipkbi-green dark:text-sipkbi-green">SIP-KBI</h1>
        </div>

        <!-- Tombol Dark Mode -->
        <button id="theme-toggle" class="p-2 rounded-md border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
            🌞
        </button>
    </header>

    <!-- ✅ MAIN: Full Background Slideshow -->
    <main class="relative w-full h-[90vh] flex items-center justify-center text-center overflow-hidden">

        <!-- 🔁 Background Gambar -->
        <div class="absolute inset-0">
            <img id="bg-slideshow" src="{{ asset('img/tambak1.jpg') }}" 
                  class="w-full h-full object-cover fade-bg opacity-100 transition-opacity duration-1000">
            <div class="absolute inset-0 bg-black/50 dark:bg-black/60"></div> <!-- Overlay -->
        </div>

        <!-- 🟩 Konten Utama -->
        <div class="relative z-10 text-white px-4">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                Selamat Datang di <span class="text-sipkbi-green">SIP-KBI</span>
            </h2>
            <p class="text-gray-200 max-w-2xl mx-auto mb-8">
                Sistem Informasi Pengelolaan Keuangan dan Hasil Budidaya Ikan — 
                bantu kelola bisnis perikanan Anda dengan mudah dan efisien.
            </p>

            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="px-6 py-2 bg-sipkbi-green text-white rounded-lg hover:bg-green-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-2 border border-sipkbi-green text-sipkbi-green rounded-lg hover:bg-sipkbi-green hover:text-white transition">
                    Register
                </a>
            </div>
        </div>
    </main>

    <!-- Tentang SIP-KBI Section -->
    <section id="tentang" class="py-16 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6 text-sipkbi-green">Tentang SIP-KBI</h2>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed max-w-3xl mx-auto">
                <strong>SIP-KBI</strong> (Sistem Informasi Pengelolaan Keuangan dan Budidaya Ikan) 
                adalah platform digital yang dirancang untuk membantu pelaku usaha perikanan dalam 
                mengelola keuangan dan hasil budidaya secara efisien, transparan, dan real-time.
            </p>

            <div class="grid md:grid-cols-3 gap-8 mt-12 text-left">
                <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-sipkbi-green mb-2">💰 Manajemen Keuangan</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Catat dan pantau transaksi keuangan usaha Anda dengan laporan yang mudah dipahami.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-sipkbi-green mb-2">🐟 Data Hasil Budidaya</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Kelola data panen, pakan, dan pertumbuhan ikan secara sistematis dan terintegrasi.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-sipkbi-green mb-2">📊 Analisis Usaha</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Dapatkan analisis dan insight otomatis untuk membantu keputusan bisnis yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
        © {{ date('Y') }} SIP-KBI. Semua Hak Dilindungi.
    </footer>

    <!-- ✅ Script Dark Mode + Slideshow -->
    <script>
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Simpan preferensi tema
        if (localStorage.theme === 'dark' || 
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            toggle.textContent = '🌙';
        } else {
            html.classList.remove('dark');
            toggle.textContent = '🌞';
        }

        toggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            toggle.textContent = isDark ? '🌙' : '🌞';
            localStorage.theme = isDark ? 'dark' : 'light';
        });

        // 🔁 Background Slideshow
        const bg = document.getElementById('bg-slideshow');
        const images = [
            "{{ asset('img/tambak1.jpg') }}",
            "{{ asset('img/ikan1.jpeg') }}",
            "{{ asset('img/orang.png') }}",
            "{{ asset('img/ikan2.jpeg') }}"
        ];
        let i = 0;

        setInterval(() => {
            bg.style.opacity = 0;
            setTimeout(() => {
                i = (i + 1) % images.length;
                bg.src = images[i];
                bg.style.opacity = 1;
            }, 800);
        }, 4000);
    </script>
</body>
</html>
