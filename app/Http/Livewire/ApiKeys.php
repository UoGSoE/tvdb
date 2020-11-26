<?php

namespace App\Http\Livewire;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Livewire\Component;

class ApiKeys extends Component
{
    public $revokeButtonText = [];

    public function render()
    {
        $users = User::with('tokens')->orderBy('username')->get();

        return view('livewire.api-keys', [
            'users' => $users,
        ]);
    }

    public function revoke($tokenId)
    {
        $tokenClass = Sanctum::$personalAccessTokenModel;

        $token = $tokenClass::findOrFail($tokenId);

        $token->delete();
    }
}
