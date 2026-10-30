<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Management;
use App\Models\Slider;

class PageController extends Controller
{
    public function home()
    {
        $sliders = Slider::active()->get();
        $clients = Client::ordered()->get();

        return view('frontend.pages.home.index', compact('sliders', 'clients'));
    }

    public function about()
    {
        return view('frontend.pages.about.index');
    }

    public function management()
    {
        $managements = Management::ordered()->get();

        return view('frontend.pages.management.index', compact('managements'));
    }

    public function contact()
    {
        return view('frontend.pages.contact.index');
    }
}