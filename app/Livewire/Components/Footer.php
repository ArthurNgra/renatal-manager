<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Footer extends Component
{
    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.Components.footer');
    }
}
