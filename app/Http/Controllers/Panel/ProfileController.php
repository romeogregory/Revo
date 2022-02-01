<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function overview()
    {
        return view('panel.profile.overview');
    }

    public function settings()
    {
        return view('panel.profile.settings');
    }
}
