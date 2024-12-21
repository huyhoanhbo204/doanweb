<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // Lấy danh sách các danh mục
        $categories = Category::all();

        // Lấy dữ liệu tìm kiếm
        $category = $request->input('category', 0);
        $status = $request->input('status', 0);
        $hot = $request->input('hot', -1);
        $name = $request->input('name', '');

        // Query tìm kiếm
        $products = Product::query();

        // Thực hiện join với bảng categories để lấy tên danh mục
        $products->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name'); // Lấy tên danh mục

        if ($category != 0) {
            $products->where('category_id', $category);
        }

        if ($status != 0) {
            $products->where('products.status', $status);
        }

        if ($hot != -1) {
            $products->where('products.hot', $hot);
        }

        if (!empty($name)) {
            $products->where('products.name', 'like', '%' . $name . '%');
        }

        $products = $products->orderBy('id', 'desc')->paginate(3);


        // Trả về AJAX nếu là request AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.product.partials.table', compact('products'))->render(),
                'pagination' => $products->appends($request->except('page'))->links('pagination::bootstrap-5')->render()
            ]);
        }

        // Trả về view nếu không phải AJAX
        return view('admin.product.index', compact('products', 'categories'));
    }




    // Hàm thêm sản phẩm mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    // Hàm lưu sản phẩm mới
    public function store(ProductRequest $request)
    {
        try {
            // Tạo một sản phẩm mới
            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->hot = $request->hot;
            $product->description = $request->description;
            $product->discount = $request->discount;
            // Xử lý ảnh nếu có
            if ($request->hasFile('image')) {
                // Lưu ảnh vào thư mục 'products' trong public storage
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            // Lưu sản phẩm vào cơ sở dữ liệu
            $product->save();

            // Chuyển hướng về trang danh sách sản phẩm với thông báo thành công
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm mới!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, quay lại trang thêm sản phẩm và giữ lại dữ liệu đã nhập
            return redirect()->route('products.create')
                ->withInput() // Giữ lại dữ liệu đã nhập
                ->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }


    // Hàm sửa sản phẩm
    public function edit($id)
    {
        // Tìm sản phẩm theo ID hoặc trả về lỗi 404 nếu không tìm thấy
        $product = Product::findOrFail($id);

        // Làm tròn discount và price về dạng số nguyên
        $product->discount = number_format($product->discount, 0, ',', '.');
        $product->price = number_format($product->price, 0, ',', '.');

        // Lấy tất cả danh mục để chọn cho sản phẩm
        $categories = Category::all();

        // Trả về view 'admin.product.edit' và truyền dữ liệu về sản phẩm và danh mục
        return view('admin.product.edit', compact('product', 'categories'));
    }


    // Hàm cập nhật sản phẩm
    public function update(ProductRequest $request, $id)
    {
        try {
            // Tìm sản phẩm cần cập nhật
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->hot = $request->hot;
            $product->description = $request->description;
            $product->discount = $request->discount;
            // Kiểm tra và xóa ảnh cũ nếu có
            if ($request->hasFile('image')) {
                // Nếu sản phẩm có ảnh cũ, xóa ảnh cũ
                if ($product->image && Storage::exists('public/' . $product->image)) {
                    Storage::delete('public/' . $product->image);
                }

                // Lưu ảnh mới vào thư mục 'products' trong public storage
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            // Lưu sản phẩm vào cơ sở dữ liệu
            $product->save();

            // Chuyển hướng về trang danh sách sản phẩm với thông báo thành công
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, quay lại trang sửa sản phẩm và giữ lại dữ liệu đã nhập
            return redirect()->route('products.edit', $id)
                ->withInput() // Giữ lại dữ liệu đã nhập
                ->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    // Hàm xóa sản phẩm
    public function destroy($id)
    {
        try {
            // Tìm sản phẩm cần xóa
            $product = Product::findOrFail($id);

            // Kiểm tra và xóa ảnh nếu có
            if ($product->image && Storage::exists('public/' . $product->image)) {
                // Xóa ảnh cũ
                Storage::delete('public/' . $product->image);
            }
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $product->delete();

            // Chuyển hướng về trang danh sách sản phẩm với thông báo thành công
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, quay lại trang danh sách và hiển thị thông báo lỗi
            return redirect()->route('products.index')
                ->with('error', 'Có lỗi xảy ra khi xóa sản phẩm!');
        }
    }
}
