<aside id="sidebar"
    class="fixed top-0 left-0 w-64 h-screen bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between transition-all duration-300 z-50">

    <div class="overflow-y-auto flex-1">
        <div class="p-5 flex items-center space-x-3 border-b border-gray-200 dark:border-gray-700">
            <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
        </div>

        <nav class="mt-6">
            @php
                $active = request()->segment(2); // Contoh: dashboard, keuangan, budidaya
            @endphp

            <a href="{{ route('karyawan.dashboard') }}"
               class="flex items-center px-6 py-3 text-sm font-medium
                      {{ $active == 'dashboard' ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">Dashboard</span>
            </a>

            <a href="{{ route('karyawan.keuangan') }}"
               class="flex items-center px-6 py-3 text-sm font-medium
                      {{ $active == 'keuangan' ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">Kelola Keuangan</span>
            </a>

            <a href="{{ route('karyawan.budidaya') }}"
               class="flex items-center px-6 py-3 text-sm font-medium
                      {{ $active == 'budidaya' ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">Kelola Budidaya</span>
            </a>
        </nav>
    </div>

    <div class="p-5 border-t   border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <button id="theme-toggle"
            class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
            🌞
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:underline text-sm">Keluar</button>
        </form>
    </div>
</aside>
