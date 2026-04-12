<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Import relasi BelongsTo
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    // Mendaftarkan kolom yang boleh diisi ke database
    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'price',
        'stock'
    ];

    // Relasi: 1 Barang MILIK 1 Kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
