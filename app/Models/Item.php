<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <- 1. Tambahkan Import ini
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory; // <- 2. Aktifkan Trait di dalam class

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'image',
        'price',
        'stock'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
