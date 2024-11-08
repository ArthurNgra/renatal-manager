<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->longText('specs')->nullable();
            $table->string('serial');
            $table->boolean('has_issue')->nullable();
            $table->float('price')->nullable();
            $table->foreignIdFor(Category::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};