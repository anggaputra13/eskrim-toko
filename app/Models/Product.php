<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'category',
        'stock',
        'price',
        'description',
        'image_url',
        'status',
    ];

    public function getNameAttribute($value): ?string
    {
        return $value ?? $this->attributes['nama_produk'] ?? null;
    }

    public function getDescriptionAttribute($value): ?string
    {
        return $value ?? $this->attributes['deskripsi'] ?? null;
    }

    public function getPriceAttribute($value): int
    {
        return (int) ($value ?? $this->attributes['harga'] ?? 0);
    }

    public function getStockAttribute($value): int
    {
        return (int) ($value ?? $this->attributes['stok'] ?? 0);
    }

    public function getImageUrlAttribute($value): ?string
    {
        $imageUrl = $value ?? $this->attributes['gambar_url'] ?? null;

        if (! $imageUrl) {
            return null;
        }

        $path = parse_url($imageUrl, PHP_URL_PATH) ?: $imageUrl;
        if (str_starts_with($path, '/storage/')) {
            return ltrim($path, '/');
        }

        if (str_starts_with($path, 'storage/')) {
            return $path;
        }

        return $imageUrl;
    }

    public function getCategoryAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        return match ((int) ($this->attributes['category_id'] ?? 0)) {
            1 => 'buah',
            2 => 'cokelat',
            default => 'favorit',
        };
    }

    public function getFlavorImageUrlAttribute(): ?string
    {
        $customImageUrl = $this->image_url;

        if ($customImageUrl) {
            return $customImageUrl;
        }

        $imageByFlavor = [
            'strawberry dream' => 'strawberry.svg',
            'blueberry cheesecake' => 'blueberry.svg',
            'minty fresh' => 'mint.svg',
            'deep cocoa' => 'chocolate.svg',
            'cookies and cream' => 'chocolate.svg',
            'cookies & cream' => 'chocolate.svg',
            'choco hazelnut' => 'chocolate.svg',
            'kopi susu gula aren' => 'coffee.svg',
            'mango sunshine' => 'mango.svg',
            'durian sultan' => 'durian.svg',
            'alpukat choco chips' => 'avocado.svg',
            'melon cream' => 'melon.svg',
            'pistachio velvet' => 'pistachio.svg',
            'kacang hijau' => 'mung-bean.svg',
            'vanilla bean bliss' => 'vanilla.svg',
            'taro creamy' => 'taro.svg',
        ];

        $name = strtolower(trim((string) ($this->attributes['name'] ?? $this->attributes['nama_produk'] ?? '')));

        return isset($imageByFlavor[$name])
            ? asset('images/flavors/' . $imageByFlavor[$name])
            : null;
    }
}
