<?php

namespace App\Services;

use App\Models\Devis;
use App\Models\Package;
use App\Models\RentalModel;
use Error;
use function array_filter;
use function count;

class PackageService
{
    public function __construct()
    {
    }

    public static function attachMaterialsToRentalDependingOnPackage(int $rentalId, $packageId, $fromDate, $toDate)
    {

        $package = Package::where('name', $packageId)->first();


        $rental = RentalModel::find($rentalId);

        if (!$rental) {
            throw new \Exception("Rental with ID $rentalId not found.");
        }

        $devis = $rental->devis->last();

        // Create a new devis if none exists
        if (!$devis || $devis->status !== 'Créer') {
            $devis = Devis::create(['rental_id' => $rentalId]);
        }


        // Retrieve available materials for the specified dates
        $materials = MaterialService::getAvailableMaterials($fromDate, $toDate);

        // Ensure package exists and has a reduction
        if ($package && $package->reduction()->exists()) {
            $packageItems = $package->packageItems()->get();
            $reduction = $package->reduction()->first();
            $packageMaterial = [];
            foreach ($packageItems as $packageItem) {

                foreach ($materials as $material) {
                    if (count(array_filter($packageMaterial, function ($materiel) use ($packageItem) {
                            return $materiel->model == $packageItem->name;
                        })) == $packageItem->quantity) {
                        break;
                    }
                    if ($material->model === $packageItem->name) {
                        $packageMaterial[] = $material;
                    }
                }
            }

            foreach ($packageItems as $packageItem) {
                if (count(array_filter($packageMaterial, function ($materiel) use ($packageItem) {
                        return $materiel->model == $packageItem->name;
                    })) < $packageItem->quantity) {
                    throw new Error('Certains produits ne sont pas disponible sur cette periode');
                }
            }

            // Attach selected materials to the rental
            $rental->materials()->attach(array_map(fn($material) => $material->id, $packageMaterial));
            $rental->save();

            if($devis->reductions->contains($reduction)) {
                throw new Error('Ce devis dispose déja de cette reduction');
            }
            $devis->reductions()->attach($reduction->id);
            $devis->save();


        }
    }
}
