<?php

namespace App\Livewire;

use App\Models\Area;
use Livewire\Component;

class SearchAreas extends Component
{
    public string $search = '';

    public function render()
    {
        $areas = Area::with('category')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.search-areas', ['areas' => $areas]);
    }
}
