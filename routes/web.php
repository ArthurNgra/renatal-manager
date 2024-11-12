<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\MaterielDj;

Route::get('/dj',MaterielDj::class)->name('dj');
Route::get('/', Home::class)->name('home');
