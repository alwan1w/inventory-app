<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <- Jangan lupa import ini

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Kita ambil ID barang yang sedang diedit dari URL
        $itemId = $this->route('item')->id;

        return [
            'category_id' => ['required', 'exists:categories,id'],
            // Validasi SKU: Harus unik, KECUALI untuk barang dengan ID ini sendiri
            'sku' => ['required', 'string', Rule::unique('items', 'sku')->ignore($itemId)],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }
}
