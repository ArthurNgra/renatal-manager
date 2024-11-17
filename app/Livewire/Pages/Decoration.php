<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\MaterialModel;
use Livewire\Component;

class Decoration extends Component
{
    public $decos;
    public  $cat;

    public function __construct()
    {
        $this->cat = Category::where('name', 'Décoration')->first();
        $this->decos = MaterialModel::where('category_id', $this->cat->id)->distinct('model')->get();

    }
    public function render()
    {
        return view('livewire.decoration');
    }
}
