<?php

use App\Models\Package;
use App\Models\PackageItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('package_package_item', function (Blueprint $table) {
            $table->foreignIdFor(PackageItem::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Package::class)->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('package_package_item', function (Blueprint $table) {
            //
        });
    }
};
