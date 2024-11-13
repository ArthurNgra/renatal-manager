<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\MaterialModel;
use Livewire\Component;

class Sonorisation extends Component
{
    public $sonos;

    public  $cat;
    public function __construct()
    {
        $this->cat = Category::where('name', 'Sonorisation')->first();
        $this->sonos = MaterialModel::where('category_id', $this->cat->id)->get();

    }
    public function render()
    {
        return view('livewire.sonorisation');
    }
}
