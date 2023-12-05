<div class="container mx-auto mt-4">
    @livewire('api-token-generator')
    <div class="py-6">
        <div class="bg-white p-8 shadow">

    <table class="table-auto w-full">
        <thead class="shadow">
            <tr>
                <th class="text-left p-2">User</th>
                <th class="text-left">Token Name</th>
                <th class="text-left">Last Used</th>
                <th class="text-left"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @foreach ($user->tokens as $token)
                    <tr class="hover:bg-gray-100" wire:key="token-{{ $token->id }}">
                        <td class="p-2">{{ $user->username }}</td>
                        <td>{{ $token->name }}</td>
                        <td>{{ $token->last_used_at?->format('d/m/Y H:i') }}</td>
                        <td><button class="p-2 rounded hover:bg-red-400 hover:text-white" wire:click="revoke({{ $token->id }})">Revoke</button></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</div>
