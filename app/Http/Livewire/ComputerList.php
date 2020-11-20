<?php

namespace App\Http\Livewire;

use App\Models\Tv;
use Livewire\Component;
use Livewire\WithPagination;

class ComputerList extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.computer-list', [
            'records' => Tv::orderByDesc('last_seen')
                ->where('computer_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('computer_id', 'like', '%' . $this->searchTerm . '%')
                ->paginate(50),
        ]);
    }
}
