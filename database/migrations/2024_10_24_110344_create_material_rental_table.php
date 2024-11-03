<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('material_rental', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id');
            $table->foreignId('material_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_rental');
    }
};
