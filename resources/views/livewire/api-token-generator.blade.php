<div class="py-2">
    <input wire:model="tokenName" placeholder="Token name" class="rounded-lg border-2 border-gray-200" type="text" name="token_name" id="token_name" >
    <button wire:click="generate" class="rounded bg-white p-2 shadow">Generate API token</button>
    <p>{{ $token }}</p>
</div>
