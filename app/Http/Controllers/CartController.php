<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

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
        $totalProducts = count($cart);

        $subtotal = array_sum(array_map(function ($product) {
            return $product['price'] * $product['quantity'];
        }, $cart));
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'totalProducts' => $totalProducts,
            'subtotal' => $subtotal
        ]);
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
            $totalProducts = count($cart);

            $subtotal = array_sum(array_map(function ($product) {
                return $product['price'] * $product['quantity'];
            }, array: $cart));



            return response()->json([
                'success' => true,
                'cart' => $cart,
                'totalProducts' => $totalProducts,
                'subtotal' => $subtotal
            ]);
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

        // Tìm voucher trong cơ sở dữ liệu theo mã giảm giá
        $voucher = \App\Models\Voucher::where('code', $discountToken)
            ->where('status', 'active') // Kiểm tra voucher có còn đang hoạt động không
            ->where('validFrom', '<=', now()) // Kiểm tra xem voucher có còn hiệu lực không (từ ngày)
            ->where('validTo', '>=', now()) // Kiểm tra xem voucher có còn hiệu lực không (đến ngày)
            ->first();

        // Kiểm tra xem voucher có tồn tại và hợp lệ không
        if ($voucher) {
            // Tính toán giá trị giảm giá
            if ($voucher->type == 'percent') {
                $discount = $voucher->discountValue / 100;
            } else {
                $discount = $voucher->discountValue;
            }

            // Tính toán tổng tiền trong giỏ hàng
            $cart = session()->get('cart', []);
            $subtotal = array_sum(array_map(function ($product) {
                return $product['price'] * $product['quantity'];
            }, $cart));

            // Áp dụng giảm giá
            $discountAmount = $subtotal * $discount;
            $newSubtotal = $subtotal - $discountAmount;
            $shipping = 2.05; // Ví dụ phí vận chuyển
            $newTotal = $newSubtotal + $shipping;

            return response()->json([
                'success' => true,
                'new_subtotal' => number_format($newSubtotal, 2),
                'new_total' => number_format($newTotal, 2)
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
            ]);
        }
    }
}
