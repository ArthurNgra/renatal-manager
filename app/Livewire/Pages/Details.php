<?php

namespace App\Livewire\Pages;

use App\Models\MaterialModel;
use Livewire\Component;
use function view;

class Details extends Component
{

    public MaterialModel $material;

    public function mount($id)
    {
        $this->material = MaterialModel::find($id);
    }


    public function render()
    {
        return view('livewire.details');
    }
}
