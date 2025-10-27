<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKeuangan;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index()
    {
        // Ambil semua data
        $keuangan = DataKeuangan::orderBy('tanggal', 'asc')->get();

        // Label tanggal (format d M)
        $labels = $keuangan->pluck('tanggal')->map(fn($date) => Carbon::parse($date)->format('d M'));

        // Data pemasukan & pengeluaran (pastikan lowercase sesuai seeder)
        $dataPemasukan = $keuangan->where('jenis', 'pemasukan')->pluck('jumlah')->values();
        $dataPengeluaran = $keuangan->where('jenis', 'pengeluaran')->pluck('jumlah')->values();

        // Ambil 5 data terbaru untuk tabel
        $latestTransactions = DataKeuangan::orderBy('tanggal', 'desc')->take(5)->get();

       // Total Pemasukan
        $totalPemasukan = DataKeuangan::where('jenis', 'Pemasukan')->sum('jumlah');

        // Total Pengeluaran
        $totalPengeluaran = DataKeuangan::where('jenis', 'Pengeluaran')->sum('jumlah');

        // Hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;


       // Dapatkan daftar bulan yang tersedia dari data
        $availableMonths = DataKeuangan::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan')
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->pluck('bulan');

        // Kirim tanggal asli untuk filter
        $tanggalAsli = $keuangan->pluck('tanggal');

        return view('dashboardKaryawan.dashboard', compact(
            'labels', 
            'dataPemasukan', 
            'dataPengeluaran', 
            'latestTransactions',
            'availableMonths',
            'tanggalAsli',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));

    }
}
