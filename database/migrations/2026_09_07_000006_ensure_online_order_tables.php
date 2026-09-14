<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->timestamp('tanggal_pesanan')->useCurrent();
                $table->decimal('total_harga', 10, 2);
                $table->string('status_pesanan', 20)->default('pending');
                $table->string('metode_pembayaran', 50);
                $table->text('alamat_pengiriman');
            });
        }

        if (! Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->integer('jumlah');
                $table->decimal('harga_satuan', 10, 2);
            });
        }
    }

    public function down(): void
    {
        // Existing order data is intentionally preserved on rollback.
    }
};
