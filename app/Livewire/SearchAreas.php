<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Area;

class SearchAreas extends Component
{
    public $search = '';

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
