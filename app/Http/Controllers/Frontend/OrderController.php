<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Package;
use App\Models\OrderItem;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $selectedPackages = $request->input('packages', []);
        $selectedItems = $request->input('items', []);

        $order = new Order();
        $order->total_price = 0; // Total price will be calculated below
        $order->save();

        $totalPrice = 0;

        // Process selected packages
        foreach ($selectedPackages as $packageId) {
            $package = Package::find($packageId);
            if ($package) {
                // Add package as order item
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->package_id = $package->id;
                $orderItem->price = $package->price;
                $orderItem->save();

                $totalPrice += $package->price;

                // Add all package items as order items
                foreach ($package->items as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->package_item_id = $item->id;
                    $orderItem->price = $item->price;
                    $orderItem->save();
                }
            }
        }

        // Process selected items
        foreach ($selectedItems as $itemId) {
            $item = PackageItem::find($itemId);
            if ($item && !in_array($item->package_id, $selectedPackages)) {
                // Add individual item as order item only if its package is not selected
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->package_item_id = $item->id;
                $orderItem->price = $item->price;
                $orderItem->save();

                $totalPrice += $item->price;
            }
        }

        $order->total_price = $totalPrice;
        $order->save();

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
}
