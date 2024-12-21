<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
        public function paymentCode(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'content' => 'nullable|string',
                'priceTotal' => 'required|numeric',
                'discount_token' => 'nullable|numeric',
            ]);

           
            $address = $request->input('address');
            $phone = $request->input('phone');
            $content = $request->input('content');
            $totalAmount = $request->input('priceTotal');
            $discountAmount = $request->input('discount_token', 0); 
            $finalAmount = $totalAmount - $discountAmount;

            $idUser = 2;  
            $idVoucher = 2;

          
            $payment_method = 'cash'; 
            $payment_status = 'pending'; 

            DB::beginTransaction();

            try {
                $bill = new Bill();
                $bill->email = 'example@example.com';  
                $bill->address = $address;
                $bill->phone = $phone;
                $bill->content = $content;
                $bill->totalAmount = $totalAmount;
                $bill->discountAmount = $discountAmount;
                $bill->finalAmount = $finalAmount;
                $bill->idUser = $idUser;
                $bill->idVoucher = $idVoucher;
                $bill->payment_method = $payment_method;
                $bill->payment_status = $payment_status;

                $bill->save();

            
                if ($idVoucher) {
                    $voucherUsage = new VoucherUsage();
                    $voucherUsage->idVoucher = $idVoucher;
                    $voucherUsage->idUser = $idUser;
                    $voucherUsage->idBill = $bill->id; 
                    $voucherUsage->usedAt = now();
                    $voucherUsage->save();
                    
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Payment processed successfully!',
                    'bill' => $bill,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing the payment.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
}
