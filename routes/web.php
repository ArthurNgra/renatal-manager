<?php

use App\Http\Controllers\DevisController;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Decoration;
use App\Livewire\Pages\Details;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Lights;
use App\Livewire\Pages\MaterielDj;
use App\Livewire\Pages\Sonorisation;
use App\Livewire\Pages\Technique;

Route::middleware(['nova.guest'])->group(function () {
    Route::get('/devis/{devisId}/acceptation/{token}', function ($devisId,$token) {
        return view('devis.acceptation',['devisId'=>$devisId,'token'=>$token]);
    });
    Route::get('/devis/{devisId}/acceptation', [DevisController::class,'changeStatus'])->name('transmettre.decision');
    Route::get('/devis/status')->name('devis.status');
    Route::get('/devis/not-available',function(){})->name('devis.not-available');
    Route::get('devis',function(){
        $img = resource_path('img/LogoOneBigCartel.jpg');
        return view('devis.DevisConfirmation',compact('img'));
    })->name('devis.index');
});
Route::get('/matérieldj', MaterielDj::class)->name('dj');
Route::get('/', Home::class)->name('home');
Route::get('/sonorisation', Sonorisation::class)->name('materiel');
Route::get('/lights', Lights::class)->name('lights');
Route::get('/technique', Technique::class)->name('technique');
Route::get('/décoration', Decoration::class)->name('decoration');
Route::get('/{any}/{id}/details', Details::class)
    ->where('any', '.*')  // Wildcard pour capturer n'importe quel chemin avant "details"
    ->name('detail');
Route::get('/contact',Contact::class)->name('contact');
