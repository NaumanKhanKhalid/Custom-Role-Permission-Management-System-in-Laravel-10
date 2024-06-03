<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

    public function index(Request $request)
    {

        $services  = Service::get();
        $totalServicesCount = 0; // Service::count();
        $activeServicesCount = 0; // Service::where('status', 'Active')->count();
        $inactiveServicesCount = 0; // Service::where('status', 'Inactive')->count();
        $trashedServicesCount =0; // Service::onlyTrashed()->count();

        return view('modules.services.index', compact('services','totalServicesCount','activeServicesCount','inactiveServicesCount','trashedServicesCount'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
