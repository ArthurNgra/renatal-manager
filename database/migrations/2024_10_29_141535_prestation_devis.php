<?php

use App\Models\Devis;
use App\Models\Prestation;
use App\Models\RentalModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prestation_devis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Devis::class,'devis_id');
            $table->foreignIdFor(Prestation::class,'prestation_id');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestation_devis');
    }
};
