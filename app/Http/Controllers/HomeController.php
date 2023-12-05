<?php

namespace App\Http\Controllers;

use App\Models\Tv;

class HomeController extends Controller
{
    public function show()
    {
        return view('dashboard', [
            'records' => Tv::orderByDesc('last_seen')->get(),
        ]);
    }
}
