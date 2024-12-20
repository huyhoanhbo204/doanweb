<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Lấy thông tin sản phẩm và số lượng
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productDescription = $request->input('product_description');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('total_price');
        dd($quantity);
        // Xử lý đơn hàng, ví dụ lưu vào cơ sở dữ liệu
        // Order::create([
        //     'product_id' => $productId,
        //     'product_name' => $productName,
        //     'product_description' => $productDescription,
        //     'quantity' => $quantity,
        //     'total_price' => $totalPrice,
        // ]);

        // Quay lại trang sản phẩm hoặc trang đơn hàng
        return redirect()->route('product_details', ['id' => $productId])->with('success', 'Order placed successfully!');
    }
}
