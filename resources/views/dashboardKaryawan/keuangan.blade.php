<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <!-- Navbar Mobile -->
    <header class="md:hidden flex items-center justify-between bg-white dark:bg-gray-800 shadow p-4">
        <!-- <h1 class="text-lg font-bold text-sipkbi-green">SIP-KBI</h1> -->
        <button id="sidebar-toggle" class="text-2xl">☰</button>
    </header>

    <!-- Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar-container"
            class="w-64 fixed md:relative z-40 md:z-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            @include('layouts.sidebar')
        </div>


        <!-- Konten Utama -->
        <main class="flex-1 p-8 md:ml-64">
            <h2 class="text-2xl font-bold mb-4">Kelola Keuangan</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Pantau pendapatan dan pengeluaran harian Anda</p>

            <!-- Konten utama di sini -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <p>Contoh isi halaman keuangan admin.</p>
            </div>
        </main>
    </div>

    <!-- Script Sidebar + Dark Mode -->
    <script>
        // Sidebar toggle (mobile)
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarContainer = document.getElementById('sidebar-container');

        sidebarToggle?.addEventListener('click', () => {
            sidebarContainer.classList.toggle('-translate-x-full');
        });

        // Dark mode toggle
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

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
    </script>
</body>
</html>
