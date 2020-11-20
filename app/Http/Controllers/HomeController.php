<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('dashboard', [
            'records' => Tv::orderByDesc('last_seen')->get(),
        ]);
    }
}
