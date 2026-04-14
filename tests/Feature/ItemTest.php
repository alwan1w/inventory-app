<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ItemTest extends TestCase
{
    // Trait ini akan mengosongkan database testing setiap kali test dijalankan
    // supaya data test tidak mengotori database aslimu.
    use RefreshDatabase;

    public function test_user_can_get_all_items(): void
    {
        // 1. Persiapan: Buat user dan login (Sanctum actingAs)
        $user = User::factory()->create();

        // 2. Aksi: Panggil API get items sebagai user tersebut
        $response = $this->actingAs($user)->getJson('/api/items');

        // 3. Verifikasi: Pastikan statusnya 200 (OK)
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data'
                 ]);
    }

    public function test_unauthenticated_user_cannot_access_items(): void
    {
        // Mencoba akses tanpa login
        $response = $this->getJson('/api/items');

        // Harus ditolak (401 Unauthorized)
        $response->assertStatus(401);
    }

    public function test_user_can_create_item_with_image(): void
    {
        // 1. Persiapan Data
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Membajak sistem penyimpanan Laravel agar menggunakan "folder palsu" (virtual)
        // Jadi file testing tidak akan beneran masuk ke folder /public komputermu
        Storage::fake('public');

        // Bikin file gambar bohongan ukurannya 100kb
        $file = UploadedFile::fake()->image('kardus.jpg')->size(100);

        // 2. Aksi: Tembak API-nya pakai form-data
        $response = $this->actingAs($user)->postJson('/api/items', [
            'category_id' => $category->id,
            'sku' => 'ROBOT-001',
            'name' => 'Barang Hasil Test Robot',
            'price' => 50000,
            'stock' => 10,
            'image' => $file,
        ]);

        // 3. Verifikasi Hasil
        // Pastikan balasan HTTP-nya 201 (Created)
        $response->assertStatus(201);

        // Pastikan datanya beneran masuk ke database
        $this->assertDatabaseHas('items', [
            'sku' => 'ROBOT-001'
        ]);

        // Ambil data item dari database untuk ngecek path gambarnya
        $item = Item::where('sku', 'ROBOT-001')->first();

        // Pastikan file gambarnya beneran "ada" di folder penyimpanan virtual tadi
        Storage::disk('public')->assertExists($item->image);
    }
}
