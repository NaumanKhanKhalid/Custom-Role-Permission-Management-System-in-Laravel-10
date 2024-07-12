<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function uploadProof(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'transaction_id' => 'required',

            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $payment = new Payment;
        $payment->order_id = $request->order_id;
        $payment->amount = $request->amount;
        $payment->transaction_id = $request->transaction_id;

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('payment_proofs'), $filename);
            $payment->payment_proof = $filename;
        }

        $payment->save();

        return redirect()->back()->with('success', 'Payment proof submitted successfully. We will verify and update your order status.');
    }

    public function viewUploadedProofs(Request $request)
    {

        $order_id = $request->order_id;
        $paymentProofs = Payment::where('order_id', $order_id)->get();

        return response()->json(['paymentProofs' => $paymentProofs]);
}
}
