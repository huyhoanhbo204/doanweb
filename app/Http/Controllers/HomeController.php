<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $categories = Category::where('status', 'active')->take(4)->get();


        $categoryId = $request->query('categoryId', 'all');


        $productsQuery = Product::where('products.status', 'active')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->take(6);


        if ($categoryId !== 'all') {
            $productsQuery->where('products.category_id', $categoryId);
        }

        $products = $productsQuery->get();

        $banners = Banner::where('active', 1)->take(4)->get();


        if ($request->ajax()) {
            return response()->json([
                'banners' => $banners,
                'categories' => $categories,
                'products' => $products
            ]);
        }


        return view('client.index', compact('banners', 'categories', 'products'));
    }
}
