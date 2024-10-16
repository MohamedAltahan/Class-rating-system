<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\HomePageSetting;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homePageSetting = HomePageSetting::first();
        return view('frontend.pages.home', compact('homePageSetting'));
    }

    public function about()
    {
        $about = About::first();
        return view('frontend.pages.about', compact('about'));
    }
}
