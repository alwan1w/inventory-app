<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
