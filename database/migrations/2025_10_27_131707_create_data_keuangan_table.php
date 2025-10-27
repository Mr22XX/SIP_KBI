<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_keuangan', function (Blueprint $table) {
            $table->id('id_keuangan'); // Primary Key
            $table->enum('jenis', ['pemasukan', 'pengeluaran']); // Jenis transaksi
            $table->decimal('jumlah', 15, 2); // Jumlah uang
            $table->date('tanggal'); // Tanggal transaksi
            $table->text('keterangan')->nullable(); // Deskripsi tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_keuangan');
    }
};

