<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Package;
use App\Models\OrderItem;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendOrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $totalPrice = $request->input('total_price');
        $selectedItems = $request->input('items');

        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($selectedItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item['id'];
            $orderItem->item_type = $item['type']; // 'package' or 'individual'
            $orderItem->price = $item['price'];
            $orderItem->save();
        }

        return response()->json(['message' => 'Order placed successfully']);
    }
}
