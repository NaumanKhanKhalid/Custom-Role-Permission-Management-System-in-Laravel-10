<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {

        $vendors = User::where('role_id', '2')->where('status', "Active")->get();


        $orders = Order::with('client','assignedUser')->get();

        return view('modules.orders.index', compact('orders', 'vendors'));
    }


    public function show($id)
    {
        $order = Order::with(['orderItems.item.package', 'orderItems.item.package.service'])->find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $items = $order->orderItems->map(function ($orderItem) {
            return [
                'name' => $orderItem->item->name,
                'price' => $orderItem->price,
            ];
        });

        $serviceName = $order->orderItems->first()->item->package->service->name;
        $packageName = $order->orderItems->first()->item->package->name;

        return response()->json([
            'order' => [
                'service_name' => $serviceName,
                'package_name' => $packageName,
            ],
            'items' => $items,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Assigned,In Progress,Rejected,Cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    public function assignVendor(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->order_id);

        $order->assigned_to = $request->input('vendor_id');
        $order->status = 'Assigned';
        $order->save();

        return redirect()->back()->with('success', 'Vendor assigned successfully.');
    }

}
