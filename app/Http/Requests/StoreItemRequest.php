<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Kategori harus diisi, dan ID-nya harus benar-benar ada di tabel categories
            'category_id' => ['required', 'exists:categories,id'],

            // SKU harus diisi, berupa teks, dan tidak boleh ada yang sama di tabel items
            'sku' => ['required', 'string', 'unique:items,sku'],

            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],

            // Stok minimal 0, tidak boleh minus
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }
}
