<?php

namespace App\Livewire\Pages;

use App\Models\MaterialModel;
use Livewire\Component;
use function config;
use function view;

class Details extends Component
{

    public MaterialModel $material;
    public $url;
    public function mount($id)
    {
        $this->material = MaterialModel::find($id);
        $this->url=config('app.url').'/storage/'. $this->material->image;
    }


    public function render()
    {
        return view('livewire.details');
    }
}
