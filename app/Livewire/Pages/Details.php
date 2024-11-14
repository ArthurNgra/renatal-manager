<?php

namespace App\Livewire\Pages;

use App\Models\MaterialModel;
use Livewire\Component;
use function config;
use function strlen;
use function view;

class Details extends Component
{

    public MaterialModel $material;
    public $url;

    public function mount($id)
    {
        $this->material = MaterialModel::find($id);
        if (strlen($this->material->image)) {
            $this->url = config('app.url') . '/storage/' . $this->material->image;
        } else
            $this->url = 'https://via.placeholder.com/300';
    }


    public function render()
    {
        return view('livewire.details');
    }
}
