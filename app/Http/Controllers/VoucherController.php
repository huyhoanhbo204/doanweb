<?php

namespace App\Http\Controllers;

use App\Http\Requests\Voucher\VoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.voucher.list', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucher.add');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(VoucherRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $voucher = new Voucher();
            $voucher->code = $validated['code'];
            $voucher->description = $validated['description'];
            $voucher->discountValue = $validated['discountValue'];
            $voucher->type = 'percent';
            $voucher->validFrom = $validated['validFrom'];
            $voucher->validTo = $validated['validTo'];
            $voucher->status = $validated['status'];
            $voucher->save();

            DB::commit();
            return redirect()->route('vouchers.index')->with('success', 'Voucher đã được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()
                ->withInput($request->all())
                ->with('error', 'Đã xảy ra lỗi trong quá trình thêm voucher. Vui lòng thử lại!');
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tìm voucher theo ID (có thể sử dụng findOrFail để tự động trả về lỗi nếu không tìm thấy)
        $voucher = Voucher::findOrFail($id);

        // Trả về view 'vouchers.edit' với dữ liệu voucher
        return view('admin.voucher.edit', compact('voucher'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::findOrFail($id);
            $validated = $request->validated();

            $voucher->code = $validated['code'];
            $voucher->description = $validated['description'];
            $voucher->discountValue = $validated['discountValue'];
            $voucher->type = 'percent';
            $voucher->validFrom = $validated['validFrom'];
            $voucher->validTo = $validated['validTo'];
            $voucher->status = $validated['status'];
            $voucher->save();

            DB::commit();
            return redirect()->route('vouchers.index')->with('success', 'Voucher đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()
                ->withInput($request->all())
                ->with('error', 'Đã xảy ra lỗi trong quá trình cập nhật voucher. Vui lòng thử lại!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::findOrFail($id);

            $voucher->delete();
            DB::commit();
            return redirect()->route('vouchers.index')->with('success', 'Voucher đã được xóa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi trong quá trình xóa voucher. Vui lòng thử lại!');
        }
    }
}
