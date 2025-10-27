<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataKeuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $startDate = Carbon::create(2025, 1, 1);

        $keteranganList = [
            'Penjualan ikan nila',
            'Penjualan ikan lele',
            'Penjualan ikan gurame',
            'Penjualan ikan koi',
            'Penjualan bibit ikan',
            'Penjualan ikan hias',
            'Penjualan ikan patin',
            'Penjualan ikan mas',
            'Penjualan ikan mujair',
            'Penjualan ikan gabus',
            'Pembelian pakan ikan',
            'Pembelian alat aerator',
            'Pembelian obat ikan',
            'Perawatan kolam',
            'Gaji karyawan',
            'Pembelian benih baru',
            'Listrik dan air',
            'Transportasi distribusi',
            'Perawatan pompa air',
            'Biaya promosi online',
        ];

        for ($i = 0; $i < 20; $i++) {
            $tanggal = $startDate->copy()->addDays($i * 10); // jarak 10 hari antar data

            if ($i < 10) {
                $jenis = 'Pemasukan';
                $jumlah = 800000 + ($i * 100000); // naik tiap data
            } else {
                $jenis = 'Pengeluaran';
                $jumlah = 300000 + (($i - 10) * 80000);
            }

            $data[] = [
                'jenis' => $jenis,
                'jumlah' => $jumlah,
                'tanggal' => $tanggal->toDateString(),
                'keterangan' => $keteranganList[$i],
                'created_at' => $tanggal->copy()->subDays(1),
                'updated_at' => $tanggal->copy()->addDays(1),
            ];
        }

        DB::table('data_keuangan')->insert($data);
    }
}

