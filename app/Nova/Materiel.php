<?php

namespace App\Nova;

use App\Models\MaterialModel;
use App\Nova\Filters\MaterielDisponible;
use App\Nova\Filters\MaterielType;

use Datomatic\NovaMarkdownTui\MarkdownTui;
use DigitalCreative\MegaFilter\MegaFilter;
use DigitalCreative\MegaFilter\MegaFilterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;

use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;


class Materiel extends Resource
{
    use MegaFilterTrait;
    public static $model = MaterialModel::class;

    public function title()
    {
        return $this->brand . ' ' . $this->model;
    }


    public static $search = [
        'id', 'brand', 'model', 'serial'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make('Marque', 'brand')
                ->sortable()
                ->rules('required'),
            Text::make('Modèle', 'model')
                ->sortable()
                ->rules('required'),
            Image::make('Image', 'image')
                ->disk('public')
                ->path('materiels') // Optionnel : sous-dossier pour organiser les images
                ->storeAs(function (Request $request) {
                    return $request->file('image')->getClientOriginalName(); // Utilise le nom d'origine
                })
                ->thumbnail(function ($value) {
                    if(Storage::url($this->image)) {
                        return Storage::url($this->image);
                    }
                    return $this->image; // URL pour les miniatures
                }),
            MarkdownTui::make('Specs')
                ->sortable()
                ->rules('nullable'),
            Text::make('N° série', 'serial')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('Category', 'category', Category::class),
            Boolean::make('etat', 'has_issue'),
            Text::make('prix', 'price'),
            BelongsToMany::make('Rentals', 'rentals', Location::class),
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [
            MegaFilter::make([
            new MaterielType,
            new MaterielDisponible()
        ]),
        ];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [

        ];
    }

    public static function relatableQuery(NovaRequest $request, $query)
    {
        return $query->orderBy('category_id')->orderBy('brand');
    }
}
