<?php

namespace App\Http\Controllers;

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
}
