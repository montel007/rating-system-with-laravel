<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function generateReport()
{
    // Retrieve the necessary data from your application's database or other sources
    $products = Product::all();
    $vendors = Vendor::all();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_created'=>$product->created_at,
                'product_owner'=>$product->vendor->name,
            ];
        }

    return view('reports.index', compact('products', 'vendors'));
}

}
