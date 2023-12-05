<?php

namespace App\Http\Controllers;

use App\Models\User;

class ApiKeyController extends Controller
{
    public function show()
    {
        return view('apikeys', [
            'users' => User::with('tokens')->orderBy('username')->get(),
        ]);
    }
}
