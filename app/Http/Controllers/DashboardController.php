<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = User::with('role')->where('id', Auth::user()->id)->first();
        return view('dashboard.index', compact('authUser'));
    }
}