<div>
    <div class="flex items-center">
        <input wire:model="tokenName" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" placeholder="Token name"/>
        <button wire:click="generate" class="px-8 rounded-r-lg bg-yellow-400  text-gray-800 font-bold p-2 border-yellow-500 border-t border-b border-r hover:bg-gray-800 hover:text-gray-100">Generate token</button>
        @if ($token)
        <p class="ml-4 border-2 border-yellow-400 py-2 px-4 bg-white">{{ $token }}</p>
        @endif
    </div>
</div>
