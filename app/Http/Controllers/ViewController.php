<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function search()
    {
        // Logic for the search view can be added here
        return view('search'); // Assuming you have a 'search' view
    }

    public function translator_detail()
    {
        return view('translator_detail');
    }
}
