<div>
<!-- component -->
<div class="flex justify-between mt-4">
    <div class="relative text-gray-600">
      <input wire:model="searchTerm" autofocus type="search" name="search" placeholder="Search..." class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none">
    </div>
</div>
    <div class="py-6">
        <div class="bg-white p-8 shadow">
            <table class="table-auto w-full">
                <thead class="shadow">
                    <tr>
                        <th class="text-left p-2">Name</th>
                        <th class="text-left">ID</th>
                        <th class="text-left">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="hover:bg-gray-100">
                            <td class="odd:bg-gray-200 p-2">{{ $record->computer_name }}</td>
                            <td class="odd:bg-gray-200">{{ $record->computer_id }}</td>
                            <td class="odd:bg-gray-200">{{ $record->last_seen->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="my-6">
            {{ $records->links() }}
        </div>
    </div>
</div>
