<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(): View
    {
        return view('dashboard', [
            'records' => Tv::orderByDesc('last_seen')->get(),
        ]);
    }
}
