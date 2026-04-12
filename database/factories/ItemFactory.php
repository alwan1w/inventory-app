<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(), // Ini otomatis membuat kategori baru jika tidak ada
            'sku' => strtoupper(fake()->unique()->bothify('??-####')), // Contoh: IT-1234
            'name' => fake()->sentence(3),
            'price' => fake()->numberBetween(10000, 1000000),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}
