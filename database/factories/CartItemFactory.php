<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart_Items>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CartItem::class;
    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(), 
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
