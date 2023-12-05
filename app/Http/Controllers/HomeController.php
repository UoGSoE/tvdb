<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Tv;

class HomeController extends Controller
{
    public function show(): View
    {
        return view('dashboard', [
            'records' => Tv::orderByDesc('last_seen')->get(),
        ]);
    }
}
