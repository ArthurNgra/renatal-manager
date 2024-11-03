<?php

namespace Database\Seeders;

use App\Models\MaterialModel;
use App\Models\RentalModel;
use App\Models\rentalMaterial;
use App\Models\User;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Seeder;
use function bcrypt;
use function database_path;
use function resource_path;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  User::factory(10)->create();



        $file_path=database_path('sql/obc-data.sql');
        \DB::unprepared(
            file_get_contents($file_path)
        );
        User::factory()->create([
            'name' => 'Arthur noguera',
            'email' => 'arthur.nogueraa@gmail.com',
            'password' => bcrypt('arthur'),
            'company_id'=>1,
        ]);
//        $materials = MaterialModel::factory(10)->create();
//        $rentals = RentalModel::factory(10)->create();
//        foreach ($rentals as $rental) {
//            // Attach between 1 and 3 random materials to each rental
//            $rental->materials()->attach(
//                $materials->random(rand(1, 3))->pluck('id')->toArray()
//            );
//        }
    }
}
