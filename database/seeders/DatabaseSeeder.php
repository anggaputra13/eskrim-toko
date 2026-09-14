<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'customer@eskrim.test'],
            [
                'nama_lengkap' => 'Customer Eskrim',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'admin@eskrim.test'],
            [
                'nama_lengkap' => 'Admin Scoops',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'kasir@eskrim.test'],
            [
                'nama_lengkap' => 'Kasir Scoops',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ],
        );

        $products = [
            [
                'name' => 'Strawberry Dream',
                'category' => 'buah',
                'price' => 20000,
                'stock' => 24,
                'description' => 'Stroberi segar dari kebun dicampur ke dalam dasar krim yang kaya dan lembut.',
                'image_url' => 'https://images.unsplash.com/photo-1567206563064-6f60f4078b57?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Minty Fresh',
                'category' => 'favorit',
                'price' => 28000,
                'stock' => 18,
                'description' => 'Peppermint dingin yang dipadukan dengan serutan cokelat hitam artisan',
                'image_url' => 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Deep Cocoa',
                'category' => 'cokelat',
                'price' => 22000,
                'stock' => 20,
                'description' => 'Cokelat Belgia 70% asli untuk pengalaman yang benar-benar intens.',
                'image_url' => 'https://images.unsplash.com/photo-1579954115545-aad51622d0b0?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Mango Sunshine',
                'category' => 'buah',
                'price' => 24000,
                'stock' => 15,
                'description' => 'Sorbet mangga harum manis murni tanpa bahan susu, segar dan manis alami.',
                'image_url' => 'https://images.unsplash.com/photo-1505394033641-40c6ad1178d7?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Pistachio Velvet',
                'category' => 'cokelat',
                'price' => 30000,
                'stock' => 12,
                'description' => 'Kacang pistacio Sisilia panggang yang diolah halus menjadi gelato gurih nan creamy.',
                'image_url' => 'https://images.unsplash.com/photo-1580915411954-282cb1b0d780?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Vanilla Bean Bliss',
                'category' => 'favorit',
                'price' => 22000,
                'stock' => 16,
                'description' => 'Polong vanila Madagaskar asli yang memberikan cita rasa klasik tak tertandingi.',
                'image_url' => 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Taro Creamy',
                'category' => 'favorit',
                'price' => 32000,
                'stock' => 20,
                'description' => 'Taro lembut dengan aroma manis yang wangi dan warna ungu yang menggoda.',
                'image_url' => 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Durian Sultan',
                'category' => 'buah',
                'price' => 38000,
                'stock' => 14,
                'description' => 'Rasa durian legit dan creamy untuk pencinta buah tropis yang berani.',
                'image_url' => 'https://images.unsplash.com/photo-1553279768-865429fa0078?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Alpukat Choco Chips',
                'category' => 'buah',
                'price' => 34000,
                'stock' => 16,
                'description' => 'Alpukat creamy dengan kejutan choco chips renyah di setiap suapan.',
                'image_url' => 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Kopi Susu Gula Aren',
                'category' => 'favorit',
                'price' => 35000,
                'stock' => 18,
                'description' => 'Perpaduan kopi wangi, susu lembut, dan manis legit gula aren.',
                'image_url' => 'https://images.unsplash.com/photo-1579954115545-aad51622d0b0?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Cookies & Cream',
                'category' => 'cokelat',
                'price' => 33000,
                'stock' => 22,
                'description' => 'Es krim susu vanilla dengan remahan cookies cokelat yang melimpah.',
                'image_url' => 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Melon Cream',
                'category' => 'buah',
                'price' => 30000,
                'stock' => 15,
                'description' => 'Rasa melon segar, ringan, dan wangi dengan tekstur yang super lembut.',
                'image_url' => 'https://images.unsplash.com/photo-1505394033641-40c6ad1178d7?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Kacang Hijau',
                'category' => 'favorit',
                'price' => 30000,
                'stock' => 12,
                'description' => 'Kacang hijau manis dengan rasa tradisional yang akrab dan menenangkan.',
                'image_url' => 'https://images.unsplash.com/photo-1580915411954-282cb1b0d780?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
            [
                'name' => 'Blueberry Cheesecake',
                'category' => 'buah',
                'price' => 36000,
                'stock' => 13,
                'description' => 'Blueberry asam manis dengan sentuhan cheesecake yang gurih dan creamy.',
                'image_url' => 'https://images.unsplash.com/photo-1567206563064-6f60f4078b57?auto=format&fit=crop&w=600&q=80',
                'status' => 'available',
            ],
        ];

        foreach ($products as $item) {
            \App\Models\Product::query()->updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
