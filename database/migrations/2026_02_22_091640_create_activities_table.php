<?php

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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable();
            $table->string('description'); // e.g., "updated", "created", "deleted"
            $table->nullableMorphs('subject'); // subject_id and subject_type (e.g., Post #1)
            $table->nullableMorphs('causer');  // causer_id and causer_type (e.g., User #5)
            $table->json('properties')->nullable(); // Stores ['old' => [...], 'attributes' => [...]]
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
