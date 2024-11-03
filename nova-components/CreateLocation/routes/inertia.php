<?php


use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;


/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', function (NovaRequest $request) {
    $clients = DB::table('clients')->get();
    $materials = DB::table('materials')->get();
    return inertia('CreateLocation', ['clients' => $clients]);
});


Route::get('/materials', [MaterialController::class, 'getAvailableMaterials'])->name('materials.index');
Route::post('/create', [RentalController::class, 'store'])->name('materials.create');

Route::get('/redirect/{resource}/{resourceId}', function ($resourceId, $resource) {
    return Redirect::to('resources/' . $resourceId . '/' . $resource, 301);
});

