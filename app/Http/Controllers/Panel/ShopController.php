<?php

namespace App\Http\Controllers\Panel;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{    
    /**
     * Return shop page view with all packages.
     *
     * @return view
     */
    public function index()
    {
        $packages = Package::orderBy('price')->get();
        return view('panel.shop', compact('packages'));
    }
}
