<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cho phép thực hiện request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required|in:admin,sales,user',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'role.required' => 'Vai trò là trường bắt buộc.',
            'role.in' => 'Vai trò phải là admin, sales hoặc user.',
            'status.required' => 'Trạng thái là trường bắt buộc.',
            'status.in' => 'Trạng thái phải là active hoặc inactive.',
        ];
    }
}
