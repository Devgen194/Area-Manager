<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Area;
use App\Models\Category;
use Livewire\WithPagination;

class ManageAreas extends Component
{
    use WithPagination;

    public $search = '';
    public $name, $coordinates, $description, $start_date, $end_date, $category_id, $display_in_breach_list;
    public $areaId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'coordinates' => 'required|json',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'category_id' => 'required|exists:categories,id',
        'display_in_breach_list' => 'nullable|boolean',
    ];

    public function clearSearch()
    {
        $this->reset('search');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $this->areaId = $area->id;
        $this->name = $area->name;
        $this->coordinates = $area->coordinates;
        $this->description = $area->description;
        $this->start_date = $area->start_date;
        $this->end_date = $area->end_date;
        $this->category_id = $area->category_id;
        $this->display_in_breach_list = $area->display_in_breach_list;
    }

    public function update()
    {
        $this->validate();

        if ($this->areaId) {
            $area = Area::find($this->areaId);

            $area->update([
                'name' => $this->name ?? $area->name,
                'coordinates' => $this->coordinates ?? $area->coordinates,
                'description' => $this->description ?? $area->description,
                'start_date' => $this->start_date ?? $area->start_date,
                'end_date' => $this->end_date ?? $area->end_date,
                'category_id' => $this->category_id ?? $area->category_id,
                'display_in_breach_list' => $this->display_in_breach_list ?? $area->display_in_breach_list,
            ]);

            session()->flash('message', 'Area updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            Area::where('id', $id)->delete();
            session()->flash('message', 'Area deleted successfully.');
        }
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->coordinates = '';
        $this->description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->category_id = '';
        $this->display_in_breach_list = false;
        $this->areaId = '';
    }

    public function render()
    {
        $areas = Area::with('category')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('livewire.manage-areas', [
            'areas' => $areas,
            'categories' => $categories
        ]);
    }
}
