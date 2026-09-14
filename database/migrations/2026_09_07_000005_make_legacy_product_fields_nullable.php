<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table): void {
            if (Schema::hasColumn('products', 'nama_produk')) {
                $table->string('nama_produk', 100)->nullable()->change();
            }
            if (Schema::hasColumn('products', 'harga')) {
                $table->decimal('harga', 10, 2)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        // Keep legacy fields nullable so current product writes remain compatible.
    }
};
