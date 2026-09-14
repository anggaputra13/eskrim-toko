<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function create(): View
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:50'],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['nullable', 'string', 'max:20'],
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = 'storage/' . $request->file('image_file')->store('products', 'public');
        }

        unset($data['image_file']);

        Product::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:50'],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['nullable', 'string', 'max:20'],
        ]);

        if ($request->hasFile('image_file')) {
            $data['image_url'] = 'storage/' . $request->file('image_file')->store('products', 'public');
        }

        unset($data['image_file']);

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
