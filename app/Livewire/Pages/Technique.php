<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\MaterialModel;
use Livewire\Component;

class Technique extends Component
{
    public $techs;
    public  $cat;

    public function __construct()
    {
        $this->cat = Category::where('name', 'Technique')->first();
        $this->techs = MaterialModel::where('category_id', $this->cat->id)->get()->unique('model');

    }
    public function render()
    {
        return view('livewire.technique');
    }
}
