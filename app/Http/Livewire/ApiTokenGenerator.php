<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ApiTokenGenerator extends Component
{
    public $token = '';

    public $tokenName = '';

    public function render()
    {
        return view('livewire.api-token-generator');
    }

    public function generate()
    {
        if (! $this->tokenName) {
            return;
        }
        $token = request()->user()->createToken($this->tokenName);

        $this->token = $token->plainTextToken;
    }
}
