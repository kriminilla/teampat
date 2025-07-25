<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Produk;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function produkuser(Request $request)
    {
        $query = $request->input('query');


        $produks = Produk::with('kategori')
            ->when($query, function ($q) use ($query) {
                $q->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($query) . '%']);
            })
            ->get();

        return view('user.product_user', compact('produks', 'query'));
    }
}
