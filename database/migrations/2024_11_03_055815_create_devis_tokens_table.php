<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('devis_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devis_id');
            $table->string('token');
            $table->boolean('used')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devis_tokens');
    }
};
