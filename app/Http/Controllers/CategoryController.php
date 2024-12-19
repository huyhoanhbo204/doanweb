<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $name = $request->input('name');
        $active = $request->input('active');
        $categories = Category::query();
        if ($name) {
            $categories->where('name', 'like', '%' . $name . '%');
        }
        if ($active !== null) {
            $categories->where('status', $active);
        }
        $categories = $categories->get();
        return view('admin.category.list', compact('categories'));
    }
    public function create()
    {
        return view("admin.category.add");
    }
    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $category = new Category();
            $category->name = $validated['name'];
            $category->status = $validated['active'];
            if ($request->hasFile('image')) {
                $category->image = $request->file('image')->store('categories', 'public');
            }
            $category->save();
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()
                ->withInput($request->all())
                ->with('error', 'Đã xảy ra lỗi trong quá trình thêm danh mục. Vui lòng thử lại!');
        }
    }







    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }



    public function update(StoreCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $category = Category::findOrFail($id);
            $category->name = $validated['name'];
            $category->status = $validated['active'];

            if ($request->hasFile('image')) {
                if ($category->image && Storage::exists('public/' . $category->image)) {
                    Storage::delete('public/' . $category->image);
                }
                $category->image = $request->file('image')->store('categories', 'public');
            }

            $category->save();
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()
                ->withInput($request->all())
                ->with('error', 'Đã xảy ra lỗi trong quá trình cập nhật danh mục. Vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            // Xóa ảnh nếu có
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }
            $category->delete();
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi trong quá trình xóa danh mục. Vui lòng thử lại!');
        }
    }
}
