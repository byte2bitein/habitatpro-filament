<?php

use App\Models\Unit;
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
        Schema::create('unit_user', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Unit::class)->constrained()->cascadeOnDelete();
            $table->enum('role', ['owner', 'tenant'])->default('owner');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->timestamps();

            $table->unique([
                'unit_id',
                'role',
            ]);
            $table->index([
                'user_id',
                'role',
            ]);
            $table->index([
                'unit_id',
                'to_date',
            ]);
            $table->index('from_date');
            $table->index('to_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_user');
    }
};
