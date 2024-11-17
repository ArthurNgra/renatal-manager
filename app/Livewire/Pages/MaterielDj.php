<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\MaterialModel;
use Livewire\Component;

class MaterielDj extends Component
{
    public $djs;
    public  $cat;

    public function __construct()
    {
        $this->cat = Category::where('name', 'MatérielDJ')->first();
        $this->djs = MaterialModel::where('category_id', $this->cat->id)->distinct('model')->get();

    }
    public function render()
    {
        return view('livewire.materiel-dj');
    }
}
