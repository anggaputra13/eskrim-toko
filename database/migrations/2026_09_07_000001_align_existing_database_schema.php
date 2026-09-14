<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->alignUsersTable();
        $this->alignProductsTable();
        $this->ensureSessionTables();
        $this->ensureLoginHistoriesTable();
    }

    public function down(): void
    {
        // Existing data is intentionally preserved when rolling back this alignment.
    }

    private function alignUsersTable(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table): void {
            if (! Schema::hasColumn('users', 'nama_lengkap')) {
                $table->string('nama_lengkap', 100)->nullable();
            }
            if (! Schema::hasColumn('users', 'no_telepon')) {
                $table->string('no_telepon', 20)->nullable();
            }
            if (! Schema::hasColumn('users', 'alamat_lengkap')) {
                $table->text('alamat_lengkap')->nullable();
            }
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer');
            }
            if (! Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }
            if (! Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
        });

        if (Schema::hasColumn('users', 'name') && Schema::hasColumn('users', 'nama_lengkap')) {
            DB::table('users')->whereNull('nama_lengkap')->update([
                'nama_lengkap' => DB::raw('name'),
            ]);
        }
    }

    private function alignProductsTable(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table): void {
            if (! Schema::hasColumn('products', 'name')) {
                $table->string('name', 100)->nullable();
            }
            if (! Schema::hasColumn('products', 'category')) {
                $table->string('category', 50)->nullable();
            }
            if (! Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (! Schema::hasColumn('products', 'price')) {
                $table->integer('price')->default(0);
            }
            if (! Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable();
            }
            if (! Schema::hasColumn('products', 'image_url')) {
                $table->string('image_url', 500)->nullable();
            }
            if (! Schema::hasColumn('products', 'status')) {
                $table->string('status', 20)->default('available');
            }
        });

        $legacyColumns = [
            'name' => 'nama_produk',
            'description' => 'deskripsi',
            'price' => 'harga',
            'stock' => 'stok',
            'image_url' => 'gambar_url',
        ];

        foreach ($legacyColumns as $current => $legacy) {
            if (Schema::hasColumn('products', $current) && Schema::hasColumn('products', $legacy)) {
                DB::table('products')->whereNull($current)->update([
                    $current => DB::raw($legacy),
                ]);
            }
        }

        if (Schema::hasColumn('products', 'category') && Schema::hasColumn('products', 'category_id')) {
            DB::table('products')->whereNull('category')->update([
                'category' => DB::raw("CASE category_id WHEN 1 THEN 'buah' WHEN 2 THEN 'cokelat' ELSE 'favorit' END"),
            ]);
        }
    }

    private function ensureSessionTables(): void
    {
        if (! Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table): void {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }

        if (! Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table): void {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    private function ensureLoginHistoriesTable(): void
    {
        if (! Schema::hasTable('login_histories')) {
            Schema::create('login_histories', function (Blueprint $table): void {
                $table->id();
                $table->string('username_or_email');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->string('status', 50)->default('SUCCESS');
                $table->dateTime('created_at')->useCurrent();
            });
        }
    }
};
