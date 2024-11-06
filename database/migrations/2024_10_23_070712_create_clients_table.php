<?php

use App\Models\InvoiceSpec;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('Society')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('mail');
            $table->longText('address');
            $table->string('siret')->nullable();
            $table->foreignIdFor(InvoiceSpec::class, 'invoice_spec_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
