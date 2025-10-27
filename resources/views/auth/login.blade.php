<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIP-KBI</title>

    <!-- ✅ Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Warna custom SIP-KBI -->
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
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition duration-500">
         <button id="theme-toggle" class="mt-6 absolute top-0 right-0 m-5 text-xl p-2 rounded-md border border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
            🌞
        </button>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="flex flex-col items-center space-x-3 mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo SIP-KBI" class="w-12 h-12">
            <h1 class="text-2xl font-bold text-sipkbi-green dark:text-sipkbi-green">SIP-KBI</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 w-80 md:w-96">
            <h2 class="text-xl font-semibold mb-4 text-center">Masuk ke Akun</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 dark:text-green-400 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-sipkbi-green focus:outline-none">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-sipkbi-green focus:outline-none">
                </div>

                <p class=" text-sm my-4">
                 <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Lupa Password ?</a>
                </p>

             

                <button type="submit"
                    class="w-full bg-sipkbi-green text-white py-2 rounded-lg hover:bg-green-700 transition">Login</button>
            </form>

            <p class="text-center text-sm mt-4">
                Belum punya akun? <a href="{{ route('register') }}" class="text-sipkbi-green hover:underline">Daftar</a>
            </p>
        </div>

        <!-- Tombol Dark Mode -->
   
    </div>

    <!-- ✅ Script Dark Mode -->
    <script>
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
