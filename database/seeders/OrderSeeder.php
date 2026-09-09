<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::all();

        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $address = $user->addresses->first();

            $subtotal = 0;
            $items = [];
            
            $numItems = rand(1, 4);
            for ($j = 0; $j < $numItems; $j++) {
                $product = $products->random();
                $qty = rand(1, 3);
                $lineTotal = $product->price * $qty;
                $subtotal += $lineTotal;

                $items[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $qty,
                    'subtotal' => $lineTotal,
                ];
            }

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address ? $address->id : null,
                'order_number' => Order::generateOrderNumber(),
                'subtotal' => $subtotal,
                'discount' => 0,
                'total' => $subtotal,
                'status' => ['pending', 'processing', 'shipped', 'completed', 'completed', 'cancelled'][rand(0, 5)],
                'created_at' => Carbon::now()->subDays(rand(1, 180)),
            ]);

            foreach ($items as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
        }
    }
}
