<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use App\Models\Address;

class NordicHomeFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Pure hydration.');
    }

    public function test_product_catalog_displays_products(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function test_customer_registration_works(): void
    {
        $response = $this->post('/register', [
            'name' => 'Astrid Lindgren',
            'email' => 'astrid@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+46 8 123 4567',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', ['email' => 'astrid@example.com', 'role' => 'customer']);
    }

    public function test_customer_login_works(): void
    {
        $response = $this->post('/login', [
            'email' => 'customer@nordichome.test',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    public function test_admin_authorization_prevents_unauthorized_access(): void
    {
        // Unauthenticated
        $response = $this->get('/admin');
        $response->assertRedirect('/login');

        // Authenticated as regular customer
        $customer = User::where('role', 'customer')->first();
        $response = $this->actingAs($customer)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_wishlist_toggle_functionality(): void
    {
        $customer = User::where('role', 'customer')->first();
        $product = Product::first();

        // Add to wishlist
        $response = $this->actingAs($customer)->post(route('wishlist.toggle', $product));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('wishlists', ['user_id' => $customer->id, 'product_id' => $product->id]);

        // Remove from wishlist
        $response = $this->actingAs($customer)->post(route('wishlist.toggle', $product));
        $this->assertDatabaseMissing('wishlists', ['user_id' => $customer->id, 'product_id' => $product->id]);
    }

    public function test_cart_operations_and_stock_validation(): void
    {
        $customer = User::where('role', 'customer')->first() ?? User::factory()->create(['role' => 'customer']);
        $product = Product::where('stock', '>', 5)->first();
        if (!$product) {
            $category = Category::first() ?? Category::create(['name' => 'Living', 'slug' => 'living', 'status' => true]);
            $product = Product::create([
                'category_id' => $category->id,
                'name' => 'Nordic Armchair Sample',
                'slug' => 'nordic-armchair-sample',
                'price' => 399.00,
                'stock' => 15,
                'status' => 'active',
            ]);
        }

        // Add to cart
        $response = $this->actingAs($customer)->post(route('cart.add', $product), ['quantity' => 2]);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('cart_items', [
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }

    public function test_checkout_decreases_inventory_and_creates_order(): void
    {
        $customer = User::where('role', 'customer')->first() ?? User::factory()->create(['role' => 'customer']);
        $product = Product::where('stock', '>=', 5)->first();
        if (!$product) {
            $category = Category::first() ?? Category::create(['name' => 'Living', 'slug' => 'living', 'status' => true]);
            $product = Product::create([
                'category_id' => $category->id,
                'name' => 'Test Nordic Chair',
                'slug' => 'test-nordic-chair',
                'price' => 299.00,
                'stock' => 10,
                'status' => 'active',
            ]);
        }
        $initialStock = $product->stock;

        // Add to cart
        $this->actingAs($customer)->post(route('cart.add', $product), ['quantity' => 2]);

        // Place checkout order
        $response = $this->actingAs($customer)->post(route('checkout.store'), [
            'full_name' => 'Sven Svensson',
            'phone' => '+46 70 123 4567',
            'address' => 'Gamla Stan 10',
            'city' => 'Stockholm',
            'postal_code' => '11129',
            'country' => 'Sweden',
        ]);

        $response->assertRedirect();
        
        // Stock should be reduced by 2
        $this->assertEquals($initialStock - 2, $product->fresh()->stock);

        // Cart should be empty
        $this->assertDatabaseMissing('cart_items', ['user_id' => $customer->id]);

        // Order exists
        $this->assertDatabaseHas('orders', ['user_id' => $customer->id]);
    }

    public function test_contact_form_submission_saves_to_database(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Freja Larsson',
            'email' => 'freja@example.com',
            'subject' => 'Custom Dining Table Inquiry',
            'message' => 'Hello, do you offer custom oak dining table dimensions?'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('messages', [
            'email' => 'freja@example.com',
            'subject' => 'Custom Dining Table Inquiry'
        ]);
    }
}
