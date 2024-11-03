<?php

use App\Http\Controllers\DevisController;
use App\Http\Controllers\MaterialController;
use App\Mail\DevisConfirmationMail;
use App\Nova\Devis;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Controllers\ResourceShowController;


Route::middleware(['nova.guest'])->group(function () {
    Route::get('/devis/{devisId}/acceptation/{token}', function ($devisId,$token) {
        return view('devis.acceptation',['devisId'=>$devisId,'token'=>$token]);
    });
    Route::get('/devis/{devisId}/acceptation', [DevisController::class,'changeStatus'])->name('transmettre.decision');
    Route::get('/devis/status')->name('devis.status');
    Route::get('/devis/not-available',function(){})->name('devis.not-available');
});
