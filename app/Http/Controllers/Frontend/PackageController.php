<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class PackageController extends Controller
{
    public function index($service)
    {
     
        $packages = Package::where('service_id', $service)->with('items')->get();
    
        $service = Service::where('id', $service)->first();

        return view('frontend.modules.packages.index', compact('packages','service'));
    }
}
