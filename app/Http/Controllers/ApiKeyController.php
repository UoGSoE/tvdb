<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function show()
    {
        return view('apikeys', [
            'users' => User::with('tokens')->orderBy('username')->get(),
        ]);
    }
}
