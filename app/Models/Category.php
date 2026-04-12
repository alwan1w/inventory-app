<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Import relasi HasMany
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Mengizinkan kolom 'name' untuk diisi
    protected $fillable = ['name'];

    // Relasi: 1 Kategori punya BANYAK Barang
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
