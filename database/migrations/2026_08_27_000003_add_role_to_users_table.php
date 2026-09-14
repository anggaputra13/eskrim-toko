<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'nama_lengkap')) {
                $table->string('nama_lengkap')->nullable()->after('name');
            }
            if (! Schema::hasColumn('users', 'no_telepon')) {
                $table->string('no_telepon')->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'alamat_lengkap')) {
                $table->text('alamat_lengkap')->nullable()->after('no_telepon');
            }
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer')->after('alamat_lengkap');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = array_filter(['nama_lengkap', 'no_telepon', 'alamat_lengkap', 'role'], fn (string $column) => Schema::hasColumn('users', $column));
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
