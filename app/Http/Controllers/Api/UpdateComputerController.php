<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateMachine;
use App\Models\Tv;
use Illuminate\Http\Request;

class UpdateComputerController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'computer_name' => 'required|string',
            'computer_id' => 'required',
        ]);

        UpdateMachine::dispatch($data['computer_name'], $data['computer_id']);

        return response()->json([
            'message' => 'ok',
            'data' => [
                'computer_name' => $data['computer_name'],
                'computer_id' => $data['computer_id'],
                'last_seen' => now(),
            ],
        ], 200);
    }
}
