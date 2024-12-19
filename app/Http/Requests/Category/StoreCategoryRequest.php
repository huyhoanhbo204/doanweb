<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cho phép thực thi yêu cầu này
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:5',
            'active' => 'required|in:active,inactive',  
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'active.required' => 'Trạng thái là bắt buộc.',
            'active.in' => 'Trạng thái không hợp lệ. Trạng thái phải là "Kích hoạt" hoặc "Ẩn".',
            'image.image' => 'Hình ảnh phải là một tập tin hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ];
    }
}
