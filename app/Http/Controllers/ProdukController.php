<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function showProductDetailView(Request $request) {
        $produk = Produk::find($request->input('id'));
        return view('user.detailProduct', compact('produk'));
    }
}
