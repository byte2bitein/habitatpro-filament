<?php

use App\Enums\SocietyType;
use App\Models\User;
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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('address')->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->string('logo')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_name')->nullable();
            $table->enum('society_type', SocietyType::cases())->default(SocietyType::RESIDENTIAL_APARTMENTS);
            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('tenant_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('filament.tenancy.default_tenant_model'))->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('tenant_user');
    }
};
