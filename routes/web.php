<?php

use App\Livewire\Pages\Decoration;
use App\Livewire\Pages\Details;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Lights;
use App\Livewire\Pages\MaterielDj;
use App\Livewire\Pages\Sonorisation;
use App\Livewire\Pages\Technique;


Route::get('/matérieldj', MaterielDj::class)->name('dj');
Route::get('/', Home::class)->name('home');
Route::get('/sonorisation', Sonorisation::class)->name('materiel');
Route::get('/lights', Lights::class)->name('lights');
Route::get('/technique', Technique::class)->name('technique');
Route::get('/décoration', Decoration::class)->name('decoration');
Route::get('/{any}/{id}/details', Details::class)
    ->where('any', '.*')  // Wildcard pour capturer n'importe quel chemin avant "details"
    ->name('detail');
