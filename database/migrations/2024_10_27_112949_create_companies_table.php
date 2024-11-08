<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('adresse');
            $table->string('town');
            $table->string('country');
            $table->string('phone');
            $table->string('mail');
            $table->string('siret');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
