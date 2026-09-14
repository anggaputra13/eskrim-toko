<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products') && ! Schema::hasColumn('products', 'updated_at')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'updated_at')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->dropColumn('updated_at');
            });
        }
    }
};
