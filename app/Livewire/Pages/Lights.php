<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\MaterialModel;
use Livewire\Component;

class Lights extends Component
{
    public $lights;
    public  $cat;

    public function __construct()
    {
        $this->cat = Category::where('name', 'Lights')->first();
        $this->lights = MaterialModel::where('category_id', $this->cat->id)->groupBy('model')->get();
    }


    public function render()
    {
        return view('livewire.lights');
    }
}
