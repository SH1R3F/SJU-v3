<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * The home page of website
     */
    public function home()
    {
        return inertia('Home/Index');
    }
}
