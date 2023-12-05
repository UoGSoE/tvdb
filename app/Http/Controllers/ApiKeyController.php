<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;

class ApiKeyController extends Controller
{
    public function show(): View
    {
        return view('apikeys', [
            'users' => User::with('tokens')->orderBy('username')->get(),
        ]);
    }
}
