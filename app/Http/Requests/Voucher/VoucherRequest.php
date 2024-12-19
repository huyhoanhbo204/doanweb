<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng
    }

    public function rules()
    {
        // Kiểm tra nếu đây là một yêu cầu cập nhật (update)
        $rules = [
            'code' => 'required|string|max:50|unique:vouchers,code' . ($this->route('voucher') ? ',' . $this->route('voucher') : ''),
            'description' => 'nullable|string',
            'discountValue' => 'required|numeric',
            'type' => 'required|in:percent,fixed',
            'validFrom' => 'required|date|after_or_equal:today',
            'validTo' => 'required|date|after:validFrom',
            'status' => 'required|in:active,inactive',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'discountValue.required' => 'Giá trị giảm giá là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'validTo.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
        ];
    }
}
