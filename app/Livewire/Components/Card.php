<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Card extends Component
{
    public $photo;
    public $brand;
    public $model;
    public $price;
    public $material;

    public $cat;

    public function mount($material, $cat)
    {

        $this->cat = $cat;
        $this->photo = $material->image ? Storage::url($material->image) : 'https://placehold.co/600x400';
        $this->brand = $material->brand;
        $this->model = $material->model;
        $this->price = $material->price;

    }


    public function render()
    {
        return view('livewire.Components.card');
    }
}
