<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        try {
            $sort = $request->input('sort', 'default');
            $direction = $request->input('direction', 'desc');

            $products = Product::with('vendor')
                ->leftJoin('ratings', 'products.id', '=', 'ratings.product_id')
   ->select('products.id', 'products.name', 'products.price', 'products.created_at', 'products.updated_at', 'products.vendor_id')
->groupBy('products.id', 'products.name', 'products.price', 'products.created_at', 'products.updated_at', 'products.vendor_id');


            switch ($sort) {
                case 'highest-ratings':
                    $products->orderByRaw('AVG(ratings.rating) DESC');
                    break;
                case 'lowest-ratings':
                    $products->orderByRaw('AVG(ratings.rating) ASC');
                    break;
                case 'date':
                    $products->orderBy('created_at', $direction);
                    break;
                default:
                    // Default sorting or invalid option
                    $products->orderBy('id', $direction);
                    break;
            }

            $products = $products->paginate(10);

            $message = $products->isEmpty() ? "No products listing at the moment" : "";
            return view('products.index', compact('products', 'message'));

        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            Log::error($e);

            // Return a response with a custom error message and status code
            return response("An error occurred. Please try again later.", 500);
        }
    }


    public function performSearch(Request $request)
{
    try {
        $keywords = $request->input('keywords');
        $rating = $request->input('rating');
        $sort = $request->input('sort', 'default');
        $direction = $request->input('direction', 'desc');

        $query = Product::with('vendor')
            ->leftJoin('ratings', 'products.id', '=', 'ratings.product_id')
            ->select('products.*')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.created_at', 'products.updated_at', 'products.vendor_id');

        // Apply search criteria
        if ($keywords) {
            $query->where('products.name', 'like', '%' . $keywords . '%');
        }

        if ($rating) {
            $query->where('ratings.rating', '=', $rating);
        }

        // Apply sorting
        switch ($sort) {
            case 'highest-ratings':
                $query->orderByRaw('AVG(ratings.rating) DESC');
                break;
            case 'lowest-ratings':
                $query->orderByRaw('AVG(ratings.rating) ASC');
                break;
            case 'date':
                $query->orderBy('products.created_at', $direction);
                break;
            default:
                $query->orderBy('products.id', $direction);
                break;
        }

        $products = $query->paginate(10);

        $message = $products->isEmpty() ? "No products found" : "";
        return view('products.index', compact('products', 'message'));

    } catch (\Throwable $e) {
        Log::error($e->getMessage());
        Log::error($e);

        return response("An error occurred. Please try again later.", 500);
    }
}



}
