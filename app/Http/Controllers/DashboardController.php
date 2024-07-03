<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total orders
        $totalOrders = Order::count();

        // Fetch total vendors
        $totalVendors = User::where('role_id',2)->count();

        // Fetch total users
        $totalClient = User::where('role_id',3)->count();

        $authUser = User::with('role')->where('id', Auth::user()->id)->first();
        return view('dashboard.index', compact('authUser', 'totalOrders', 'totalVendors', 'totalClient'));
    }
}
