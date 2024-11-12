<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Menu extends Component
{
    public $activeMenu = 'home'; // Menu actif par défaut

    public function setActiveMenu($menu)
    {
        $this->activeMenu = $menu;
    }

    public function render()
    {
        return view('livewire.Components.menu');
    }
}
