<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['user_id']);

            // Jadikan user_id boleh NULL
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Jika user dihapus, user_id produk menjadi NULL
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['user_id']);

            // Kembalikan menjadi wajib diisi
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Kembalikan ke RESTRICT
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
        });
    }
};