<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ApiKeyController extends Controller
{
    public function show(): View
    {
        return view('apikeys', [
            'users' => User::with('tokens')->orderBy('username')->get(),
        ]);
    }
}
