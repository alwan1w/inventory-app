<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <- 1. Tambahkan Import ini
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory; // <- 2. Aktifkan Trait di dalam class

    protected $fillable = ['name'];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
