<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('user_type', ['umum', 'organisasi']);
            $table->string('nama_lengkap');
            $table->string('nomor_telepon');
            $table->string('nama_instansi')->nullable();
            $table->date('tanggal_ambil');
            $table->string('durasi_sewa');
            $table->integer('durasi_custom')->nullable();
            $table->date('tanggal_kembali');
            $table->string('dokumen_jaminan');
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->string('surat_peminjaman')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('syarat_ketentuan')->default(false);
            $table->json('cart_items');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('additional_cost', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('nominal_bayar')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
