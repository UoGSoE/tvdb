<div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div>
                <input wire:model="searchTerm" type="text" id="first_name" placeholder="Search..." autofocus class="mt-1 p-4 border-b-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg">
            </div>
        </h2>

    <div class="py-12">
        <div class="bg-white mx-12 p-8 shadow">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">ID</th>
                        <th class="text-left">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="hover:bg-gray-100">
                            <td class="odd:bg-gray-200">{{ $record->computer_name }}</td>
                            <td class="odd:bg-gray-200">{{ $record->computer_id }}</td>
                            <td class="odd:bg-gray-200">{{ $record->last_seen->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
    </div>
</div>
