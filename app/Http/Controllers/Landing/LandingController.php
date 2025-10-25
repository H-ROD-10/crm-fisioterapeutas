<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Muestra la página principal de landing
     */
    public function index()
    {
        return view('landing.pages.home');
    }

    /**
     * Muestra la página de demo
     */
    public function demo()
    {
        return view('landing.pages.demo');
    }
}
