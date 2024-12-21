<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Xác định liệu người dùng có quyền gửi yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Đảm bảo rằng tất cả người dùng đều có quyền gửi yêu cầu
    }

    /**
     * Lấy các quy tắc xác thực cho yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'hot' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string|max:1000', 
            'discount' => 'nullable|numeric|min:0|max:100', 
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'status.required' => 'Trạng thái sản phẩm là bắt buộc.',
            'status.in' => 'Trạng thái phải là "active" hoặc "inactive".',
            'hot.required' => 'Vui lòng chọn sản phẩm HOT.',
            'hot.boolean' => 'Trạng thái HOT không hợp lệ.',
            'image.image' => 'Vui lòng chọn một hình ảnh hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png, hoặc gif.',
            'image.max' => 'Ảnh không được lớn hơn 2MB.',
            'description.string' => 'Mô tả phải là văn bản.',
            'description.max' => 'Mô tả không được dài hơn 1000 ký tự.',
            'discount.numeric' => 'Giảm giá phải là một số.',
            'discount.min' => 'Giảm giá không được nhỏ hơn 0.',
            'discount.max' => 'Giảm giá không được lớn hơn 100.',
        ];
    }
}
