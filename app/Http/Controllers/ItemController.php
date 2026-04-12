<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Item::with('category')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    public function store(StoreItemRequest $request){
        // Jika kode sampai ke baris ini, artinya data SUDAH PASTI VALID.
        // Kita tinggal ambil data yang sudah tervalidasi dan masukkan ke database.
        $item = Item::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan ke gudang.',
            'data' => $item
        ], 201); // 201 adalah kode HTTP standar untuk "Created" (Berhasil Dibuat)
    }

    public function show(Item $item)
    {
        // Otomatis load relasi kategorinya
        $item->load('category');

        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    // Mengubah data barang
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Data barang berhasil diperbarui.',
            'data' => $item
        ]);
    }

    // Menghapus data barang
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil dihapus dari sistem.'
        ]);
    }
}
