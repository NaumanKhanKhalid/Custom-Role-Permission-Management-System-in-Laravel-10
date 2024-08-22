<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Package;

class BackendOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::with('client', 'assignedUser', 'orderItems', 'paymentProofs');
        if ($user->role->name == "Admin") {
            $orders = $orders->get();
        } elseif ($user->role->name == "Vendor") {
            $orders = $orders->where('assigned_to', $user->id)->get();
        } else {
            $orders = $orders->where('user_id', $user->id)->get();
        }

        $vendors = User::where('role_id', '2')->where('status', "Active")->get();
        return view('modules.orders.index', compact('orders', 'vendors'));
    }
    public function show($id)
{
    $order = Order::with('orderItems.item')->find($id);

    if (!$order) {
        return response()->json([
            'error' => 'Order not found'
        ], 404);
    }

    $service_name = null;
    $package_name = null;

    $items = $order->orderItems->map(function ($orderItem) use (&$service_name, &$package_name) {
        if ($orderItem->item_type == 'item') {
            return [
                'name' => $orderItem->item->name,
                'price' => $orderItem->price,
                'progress_percentage' => $orderItem->progress_percentage,
                'id' => $orderItem->id,
            ];
        } else if ($orderItem->item_type == 'package') {
            $package = Package::with('service')->find($orderItem->item_id);
            if ($package) {
                $package_name = $package->name;
                $service_name = $package->service->name;
            }
            return null; // Return null for packages to filter them out later
        }
    })->filter()->values();

    return response()->json([
        'order' => [
            'service_name' => $service_name,
            'package_name' => $package_name,
        ],
        'items' => $items
    ]);
}

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Assigned,In Progress,Rejected,Cancelled,Awaiting Payment,Completed'
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


    public function updateProgress(Request $request)
    {
        $this->validate($request, [
            'progress_percentage.*' => 'required|integer|min:0|max:100',
            'item_ids.*' => 'required|exists:order_items,id',
            'order_id' => 'required|integer',
        ]);

        $progressPercentages = $request->progress_percentage;
        $itemIds = $request->item_ids;
        $orderId = $request->order_id;

        $order = Order::findOrFail($orderId);

        $totalProgress = count($progressPercentages) > 0 ? array_sum($progressPercentages) / count($progressPercentages) : 0;

        $order->total_progress_percentage = $totalProgress;
        $order->save();

        // Update each item's progress percentage
        foreach ($itemIds as $index => $itemId) {
            $item = OrderItem::findOrFail($itemId);
            $item->progress_percentage = $progressPercentages[$index];
            $item->save();
        }

        return redirect()->back()->with('success', 'Progress updated successfully.');
    }
}
