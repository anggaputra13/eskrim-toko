<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'stock') && Schema::hasColumn('products', 'stok')) {
            DB::table('products')
                ->where('stock', 0)
                ->whereNotNull('stok')
                ->update(['stock' => DB::raw('stok')]);
        }

        if (Schema::hasColumn('products', 'price') && Schema::hasColumn('products', 'harga')) {
            DB::table('products')
                ->where('price', 0)
                ->whereNotNull('harga')
                ->update(['price' => DB::raw('harga')]);
        }
    }

    public function down(): void
    {
        // Keep the backfilled values when rolling back this data correction.
    }
};
