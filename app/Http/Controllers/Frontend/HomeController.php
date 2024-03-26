<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::whereStatus('active')
            ->orderBy('serial', 'desc')->get();

        return view('frontend.home.home', compact('sliders'));
    }
}
