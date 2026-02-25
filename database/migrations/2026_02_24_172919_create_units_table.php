<?php

use App\Enums\UnitStatus;
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
            $table->foreignIdFor(UnitType::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Building::class)->constrained()->cascadeOnDelete();
            $table->decimal('maintenance_rate', 12, 2);
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
            $table->string('unit_status')->default(UnitStatus::VACANT->value);
            $table->unique(['building_id', 'number', 'tenant_id']);
            $table->timestamps();
            $table->index('building_id');
            $table->index('tenant_id');
            $table->index('unit_type_id');
            $table->softDeletes();
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
