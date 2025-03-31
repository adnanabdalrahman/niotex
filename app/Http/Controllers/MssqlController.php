<?php

namespace App\Http\Controllers;

use App\Http\Requests\SAPStockRequest;
use App\Services\SAPService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class MssqlController extends Controller
{
    public function getProducts()
    {
        try {
            // Fetch products from the second database using DB::connection
            $products = DB::connection('sqlsrv2')->select("SELECT * FROM products");

            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching products',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
