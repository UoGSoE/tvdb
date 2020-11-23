<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $computer = Tv::where('computer_name', '=', $data['computer_name'])->firstOrCreate([
            'computer_name' => $data['computer_name'],
            'computer_id' => $data['computer_id'],
        ]);

        $computer->computer_name = $data['computer_name'];
        $computer->computer_id = $data['computer_id'];
        $computer->last_seen = now();
        $computer->save();

        return response()->json([
            'message' => 'ok',
            'data' => $computer->toJson(),
        ], 200);
    }
}
