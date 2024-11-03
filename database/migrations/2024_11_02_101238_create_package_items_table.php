<?php

use App\Models\Reduction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('package_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_items');
    }
};
