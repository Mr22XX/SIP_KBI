<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan | SIP-KBI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <button id="sidebar-toggle" class="text-2xl">☰</button>
        <h1 class="font-bold text-sipkbi-green">SIP-KBI</h1>
    </header>

    <!-- Overlay (gelap di belakang sidebar, hanya tampil di mobile) -->
    <div id="sidebar-overlay" 
         class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <!-- Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar-container"
            class="fixed md:relative inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-md transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            
            <!-- Tombol X hanya tampil di mobile -->
            <div class="md:hidden flex justify-end p-4">
                <button id="sidebar-close" class="text-2xl text-gray-500 hover:text-gray-700 dark:text-gray-300">✕</button>
            </div>

            @include('layouts.sidebar')
        </div>

        <!-- Konten Utama -->
        <main class="flex-1 p-8 overflow-y-auto h-screen">
            <h2 class="text-2xl font-bold mb-4">Dashboard Utama</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                Pantau pendapatan dan pengeluaran harian Anda
            </p>

            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Saldo</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
            </div>

             <!-- Filter Bulan -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
                <h3 class="text-lg font-semibold text-sipkbi-green">Grafik Keuangan</h3>
                <select id="month-filter" class="border border-gray-300 dark:border-gray-700 rounded-lg p-2 bg-white dark:bg-gray-800">
                    <option value="all">Semua Bulan</option>
                    @foreach ($availableMonths as $month)
                        <option value="{{ $month }}">{{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Chart Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-green-600">Grafik Pemasukan</h3>
                    <canvas id="chartPemasukan"></canvas>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-red-500">Grafik Pengeluaran</h3>
                    <canvas id="chartPengeluaran"></canvas>
                </div>
            </div>

            <!-- Tabel Riwayat Transaksi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>

                <!-- Wrapper agar tabel bisa di-scroll di layar kecil -->
                <div class="overflow-x-auto">
                    <table class="min-w-[600px] w-full text-sm border-collapse">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-3 text-left">Tanggal</th>
                                <th class="py-2 px-3 text-left">Tipe</th>
                                <th class="py-2 px-3 text-left">Kategori</th>
                                <th class="py-2 px-3 text-left">Deskripsi</th>
                                <th class="py-2 px-3 text-right">Jumlah (Rp)</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($latestTransactions as $item)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="py-2 px-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td class="py-2 px-3">{{ $item->jenis }}</td>
                                    <td class="py-2 px-3">
                                        @if ($item->jenis == 'pemasukan')
                                            <span class="text-green-600 font-medium">Pemasukan</span>
                                        @else
                                            <span class="text-red-500 font-medium">Pengeluaran</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-3">{{ $item->keterangan }}</td>
                                    <td class="py-2 px-3 text-right {{ $item->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $item->jenis == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    <script>
        // === SIDEBAR TOGGLE ===
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarContainer = document.getElementById('sidebar-container');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebarContainer.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        sidebarClose?.addEventListener('click', () => {
            sidebarContainer.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebarContainer.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // === DARK MODE ===
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
        toggle?.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            toggle.textContent = isDark ? '🌙' : '🌞';
            localStorage.theme = isDark ? 'dark' : 'light';
        });

        // === CHART DATA ===
        const labels = @json($labels); // Sudah diformat (misal: "05 Okt")
        const tanggalAsli = @json($tanggalAsli); // Format YYYY-MM-DD dari controller
        const dataPemasukan = @json($dataPemasukan);
        const dataPengeluaran = @json($dataPengeluaran);

        // === CHART INITIALIZATION ===
        const ctxPemasukan = document.getElementById('chartPemasukan').getContext('2d');
        const ctxPengeluaran = document.getElementById('chartPengeluaran').getContext('2d');

        const chartPemasukan = new Chart(ctxPemasukan, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: dataPemasukan,
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.2)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: { responsive: true }
        });

        const chartPengeluaran = new Chart(ctxPengeluaran, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: dataPengeluaran,
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.2)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: { responsive: true }
        });

        // === FILTER BULAN ===
        document.getElementById('month-filter').addEventListener('change', (e) => {
            const selectedMonth = e.target.value; // format: YYYY-MM
            if (selectedMonth === 'all') {
                updateCharts(labels, dataPemasukan, dataPengeluaran);
            } else {
                const filteredLabels = [];
                const filteredPemasukan = [];
                const filteredPengeluaran = [];

                tanggalAsli.forEach((tgl, i) => {
                    if (tgl.startsWith(selectedMonth)) {
                        filteredLabels.push(labels[i]);
                        filteredPemasukan.push(dataPemasukan[i]);
                        filteredPengeluaran.push(dataPengeluaran[i]);
                    }
                });

                updateCharts(filteredLabels, filteredPemasukan, filteredPengeluaran);
            }
        });

        // === UPDATE CHART FUNCTION ===
        function updateCharts(newLabels, newPemasukan, newPengeluaran) {
            chartPemasukan.data.labels = newLabels;
            chartPemasukan.data.datasets[0].data = newPemasukan;
            chartPemasukan.update();

            chartPengeluaran.data.labels = newLabels;
            chartPengeluaran.data.datasets[0].data = newPengeluaran;
            chartPengeluaran.update();
        }
    </script>
</body>
</html>
