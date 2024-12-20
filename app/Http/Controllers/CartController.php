<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session hoặc khởi tạo mảng rỗng

        $productId = $request->input('id');
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $quantity = $request->input('quantity');
        $image = $request->input('image');
        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity,
                'image' => $image
            ];
        }

        session()->put('cart', $cart); // Lưu giỏ hàng vào session

        return response()->json(['success' => true, 'cart' => $cart]);
    }


    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        if (isset($cart[$productId])) {
            // Cập nhật số lượng sản phẩm
            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                // Xóa sản phẩm nếu số lượng <= 0
                unset($cart[$productId]);
            }

            session()->put('cart', $cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart']);
    }


    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('client.partials.cart', compact('cart'));
    }



    public function applyDiscount(Request $request)
    {

        $discountToken = $request->input('discount_token');


        $validDiscounts = [
            'DISCOUNT10' => 0.10,
            'DISCOUNT20' => 0.20
        ];

        //Kiểm tra token có tồn tại không 
        if (array_key_exists($discountToken, $validDiscounts)) {

            $discount = $validDiscounts[$discountToken];


            $cart = session()->get('cart', []);
            $subtotal = array_sum(array_map(function ($product) {
                return $product['price'] * $product['quantity'];
            }, $cart));


            $discountAmount = $subtotal * $discount;
            $newSubtotal = $subtotal - $discountAmount;
            $shipping = 2.05;
            $newTotal = $newSubtotal + $shipping;


            return response()->json([
                'success' => true,
                'new_subtotal' => number_format($newSubtotal, 2),
                'new_total' => number_format($newTotal, 2)
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
