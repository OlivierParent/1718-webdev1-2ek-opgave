<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = 'CloCart';

        return view('home', compact('title'));
    }
}
