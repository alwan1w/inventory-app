<?php

namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 5 kategori, dan setiap kategori punya 10 barang
        Category::factory(5)->hasItems(10)->create();
    }
}
