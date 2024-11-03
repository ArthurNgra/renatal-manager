<?php

namespace App\Providers;


use Achi\CreateLocation\CreateLocation;
use App\Models\MaterialModel;
use App\Models\RentalModel;
use App\Nova\Client;
use App\Nova\Company;
use App\Nova\Dashboards\Main;
use App\Nova\Devis;

use App\Nova\Facture;
use App\Nova\Location;
use App\Nova\Materiel;
use App\Nova\ElementDePackage;
use App\Nova\Package;
use App\Nova\Prestation;
use App\Nova\Reductions;
use App\Nova\Utilisateur;

use App\Policies\ClientPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\RentalPolicy;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        parent::boot();
        Nova::style('nova-logo', asset('css/nova-logo.css'));
        Nova::mainMenu(function () {
            return [
                MenuSection::dashboard(Main::class),
                MenuSection::make('Clients ', [
                    MenuItem::resource(Client::class)->name('Clients'),
                ])->icon('user')->collapsable(),

                MenuSection::make('Locations & materiel', [
                    MenuItem::resource(Location::class)->name('Locations'),
                    MenuItem::resource(Materiel::class)->name('Materiel'),
                    MenuItem::resource(Prestation::class)->name('Prestations'),
                    MenuItem::resource(Package::class)->name('Packages'),
                    MenuItem::resource(ElementDePackage::class)->name('Elements de package'),
                    ])->collapsable(),
                MenuSection::make('Devis et factures', [
                    MenuItem::resource(Devis::class)->name('Devis'),
                    MenuItem::resource(Reductions::class)->name('Reductions'),
                MenuItem::resource(Facture::class)->name('Factures')
                ])->icon('scale')->collapsable(),

                MenuSection::make(' Utilisateurs', [
                    MenuItem::resource(Utilisateur::class)->name('Utilisateur'),
                    MenuItem::resource(Company::class)->name('Societe'),
                ])->icon('user')->collapsable(),

            ];

        });
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

        ];
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });

        Gate::policy(MaterialModel::class, MaterialPolicy::class);
        Gate::policy(RentalModel::class, RentalPolicy::class);
        Gate::policy(Client::class, ClientPolicy::class);

    }
    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main,
        ];
    }
}
