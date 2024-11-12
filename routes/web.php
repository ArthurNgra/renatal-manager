<?php

use App\Livewire\Decoration;
use App\Livewire\Lights;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\MaterielDj;
use App\Livewire\Sonorisation;
use App\Livewire\Technique;


Route::get('/dj',MaterielDj::class)->name('dj');
Route::get('/', Home::class)->name('home');
Route::get('/sono', Sonorisation::class)->name('materiel');
Route::get('/lights', Lights::class)->name('lights');
Route::get('/technique',Technique::class)->name('technique');
Route::get('/deco', Decoration::class)->name('decoration');
