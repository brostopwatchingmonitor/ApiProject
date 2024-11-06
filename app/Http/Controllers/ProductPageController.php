<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductPageController extends Controller
{
    public function index()
    {
        // Panggil API menggunakan Http facade
        $response = Http::get('http://localhost:8000/api/products');
        $products = $response->json();

        // Kirim data ke view
        return view('products.index', compact('products'));
    }
}