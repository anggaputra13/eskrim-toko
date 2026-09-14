<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_list_products(): void
    {
        $admin = User::factory()->create([
            'nama_lengkap' => 'Admin Scoops',
            'email' => 'admin@eskrim.test',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('products.store'), [
            'name' => 'Coklat Lava',
            'category' => 'classic',
            'stock' => 12,
            'price' => 22000,
            'status' => 'low_stock',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseHas('products', [
            'name' => 'Coklat Lava',
            'category' => 'classic',
            'stock' => 12,
            'price' => 22000,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Coklat Lava');

        $this->actingAs($admin)
            ->get(route('menu'))
            ->assertOk()
            ->assertSee('Coklat Lava');

        $this->actingAs($admin)
            ->get(route('cashier.dashboard'))
            ->assertOk()
            ->assertSee('Coklat Lava');
    }

    public function test_custom_image_url_is_used_on_menu_and_cashier(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $imageUrl = 'https://example.com/strawberry-custom.jpg';

        Product::create([
            'name' => 'Strawberry Dream',
            'category' => 'buah',
            'stock' => 10,
            'price' => 22000,
            'image_url' => $imageUrl,
            'status' => 'available',
        ]);

        $this->actingAs($admin)
            ->get(route('menu'))
            ->assertOk()
            ->assertSee($imageUrl, false);

        $this->actingAs($admin)
            ->get(route('cashier.dashboard'))
            ->assertOk()
            ->assertSee($imageUrl, false);
    }

    public function test_customer_can_submit_online_order_with_delivery_details(): void
    {
        $customer = User::factory()->create([
            'nama_lengkap' => 'Customer Online',
            'email' => 'customer-online@eskrim.test',
            'role' => 'customer',
        ]);
        $product = Product::create([
            'name' => 'Order Test',
            'category' => 'favorit',
            'stock' => 10,
            'price' => 25000,
            'status' => 'available',
        ]);

        $response = $this->actingAs($customer)->postJson(route('orders.store'), [
            'name' => 'Customer Online',
            'phone' => '081234567890',
            'address' => 'Jl. Es Krim No. 8',
            'payment_method' => 'qris',
            'items' => [['product_id' => $product->id, 'qty' => 2]],
        ]);

        $response->assertOk()->assertJsonStructure(['message', 'order_id']);
        $this->assertDatabaseHas('orders', [
            'user_id' => $customer->id,
            'metode_pembayaran' => 'qris',
            'alamat_pengiriman' => 'Jl. Es Krim No. 8',
        ]);
        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'jumlah' => 2,
        ]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }
}
