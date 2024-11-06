<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoice_specs', function (Blueprint $table) {
            $table->id();
            $table->string('tva');
            $table->string('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_specs');
    }
};
