<?php

use App\Models\Building;
use App\Models\Tenant;
use App\Models\UnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('floor');
            $table->foreignIdFor(UnitType::class);
            $table->foreignIdFor(Building::class)->constrained()->cascadeOnDelete();
            $table->decimal('maintenance_rate', 10, 2);
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->unique(['building_id', 'number', 'tenant_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
