<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();

        // Lọc theo trạng thái
        if ($request->has('active') && $request->active !== '') {
            $query->where('active', $request->active);
        }

        // Lọc theo tên banner
        if ($request->has('name')) {
            $query->where('banner_title', 'like', '%' . $request->name . '%');
        }

        // Lấy danh sách banner
        $banners = $query->paginate(10); // Phân trang

        return view('admin.banner.list', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.add'); // Chỉ định view thêm banner
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'banner_text' => 'required|string',
            'active' => 'required|boolean',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Lưu banner
            $bannerData = [
                'banner_title' => $request->input('banner_title'),
                'banner_subtitle' => $request->input('banner_subtitle'),
                'banner_text' => $request->input('banner_text'),
                'active' => $request->input('active'),
            ];

            // Lưu hình ảnh nếu có
            if ($request->hasFile('img')) {
                $imagePath = $request->file('img')->store('public/banners'); // Lưu vào thư mục 'public/banners'
                $bannerData['img'] = basename($imagePath); // Lưu tên ảnh vào mảng dữ liệu
            }

            // Lưu dữ liệu vào bảng
            Banner::create($bannerData);

            // Chuyển hướng về trang danh sách banner với thông báo thành công
            return redirect()->route('banners.index')->with('success', 'Banner đã được thêm thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi, quay lại với thông báo lỗi
            return back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!');
        }
    }

    public function edit($id)
    {
        // Lấy banner theo ID
        $banner = Banner::findOrFail($id);

        // Trả về view chỉnh sửa và truyền banner vào
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'banner_text' => 'required|string',
            'active' => 'required|boolean',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Lấy banner theo ID
            $banner = Banner::findOrFail($id);

            // Lưu dữ liệu banner
            $bannerData = [
                'banner_title' => $request->input('banner_title'),
                'banner_subtitle' => $request->input('banner_subtitle'),
                'banner_text' => $request->input('banner_text'),
                'active' => $request->input('active'),
            ];

            // Nếu có ảnh mới, xóa ảnh cũ và lưu ảnh mới
            if ($request->hasFile('img')) {
                // Xóa ảnh cũ nếu tồn tại
                if ($banner->img && Storage::exists('public/banners/'.$banner->img)) {
                    Storage::delete('public/banners/'.$banner->img);
                }

                // Lưu ảnh mới
                $imagePath = $request->file('img')->store('public/banners');
                $bannerData['img'] = basename($imagePath);
            }

            // Cập nhật dữ liệu banner
            $banner->update($bannerData);

            // Chuyển hướng về trang danh sách banner với thông báo thành công
            return redirect()->route('banners.index')->with('success', 'Banner đã được cập nhật thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi, quay lại với thông báo lỗi
            return back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        try {
            // Lấy banner theo ID
            $banner = Banner::findOrFail($id);

            // Xóa ảnh nếu có
            if ($banner->img && Storage::exists('public/banners/'.$banner->img)) {
                Storage::delete('public/banners/'.$banner->img);
            }

            // Xóa banner
            $banner->delete();

            // Chuyển hướng về trang danh sách banner với thông báo thành công
            return redirect()->route('banners.index')->with('success', 'Banner đã được xóa thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi, quay lại với thông báo lỗi
            return back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!');
        }
    }
}
