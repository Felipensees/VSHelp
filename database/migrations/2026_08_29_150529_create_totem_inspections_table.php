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
        Schema::create('totem_inspections', function (Blueprint $table) {
            $table->id();

            $table->string('order_number');
            $table->string('serial_number');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', [
                'draft',
                'finalized',
            ])->default('draft');

            $table->timestamp('finalized_at')->nullable();

            $table->timestamps();

            $table->unique([
                'order_number',
                'serial_number',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totem_inspections');
    }
};
