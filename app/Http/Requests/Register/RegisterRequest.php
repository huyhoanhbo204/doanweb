<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Xác định liệu người dùng có quyền thực hiện yêu cầu này không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cho phép người dùng thực hiện request này
    }

    /**
     * Lấy các quy tắc xác thực cho yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date|before:-18 years', // Đảm bảo người dùng 18 tuổi
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi cho các quy tắc xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'fullname.required' => 'Tên đầy đủ là bắt buộc.',
            'fullname.string' => 'Tên đầy đủ phải là chuỗi ký tự.',
            'fullname.max' => 'Tên đầy đủ không được vượt quá 255 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'birthday.before' => 'Bạn phải ít nhất 18 tuổi để đăng ký.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ];
    }

    /**
     * Xác định các thuộc tính yêu cầu.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'fullname' => 'Tên đầy đủ',
            'phone' => 'Số điện thoại',
            'birthday' => 'Ngày sinh',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu',
        ];
    }
}