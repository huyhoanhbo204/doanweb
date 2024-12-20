<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{

    private function getCategoriesAndProducts(Request $request, $takeProducts = 6)
    {

        $categories = Category::where('status', 'active')->take(4)->get();


        $categoryId = $request->query('categoryId', '0');


        $productsQuery = Product::where('products.status', 'active')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name');

        if ($request->input('name') !== '') {
            $productsQuery->where('products.name', 'like', '%' . $request->get('name') . '%');
        }



        if ($categoryId > 0) {
            $productsQuery->where('products.category_id', $categoryId)
                ->take($takeProducts);
        } elseif ($categoryId == 0) {
            $productsQuery->take($takeProducts);
        } elseif ($categoryId < 0) {
            $productsQuery->take(PHP_INT_MAX);
        }

        $products = $productsQuery->get();

        $cart = session()->get('cart', []);

        return [
            'categories' => $categories,
            'products' => $products,
            'cart' => $cart
        ];
    }





    public function index(Request $request)
    {
        // Lấy danh sách banner
        $banners = Banner::where('active', 1)->take(4)->get();

        // Lấy danh mục, sản phẩm và giỏ hàng
        $data = $this->getCategoriesAndProducts($request);

        if ($request->ajax()) {
            return response()->json([
                'banners' => $banners,
                'categories' => $data['categories'],
                'products' => $data['products'],
                'cart' => $data['cart'], // Trả về giỏ hàng
            ]);
        }

        // Trả về view với giỏ hàng
        return view('client.partials.home', [
            'banners' => $banners,
            'categories' => $data['categories'],
            'products' => $data['products'],
            'cart' => $data['cart'], // Truyền giỏ hàng vào view
        ]);
    }


    public function product(Request $request)
    {

        $data = $this->getCategoriesAndProducts($request, 30);

        if ($request->ajax()) {
            return response()->json([
                'categories' => $data['categories'],
                'products' => $data['products'],
                'cart' => $data['cart'], // Trả về giỏ hàng
            ]);
        }

        // Trả về view với giỏ hàng
        return view('client.partials.product', [
            'categories' => $data['categories'],
            'products' => $data['products'],
            'cart' => $data['cart'], // Truyền giỏ hàng vào view
        ]);
    }


    public function cart()
    {
        return view('client.partials.cart');
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('client.partials.product_details', compact('product'));
    }
}
