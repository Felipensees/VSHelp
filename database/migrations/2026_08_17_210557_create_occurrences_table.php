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
        Schema::create('occurrences', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('description');

            $table->foreignId('totem_model_id')
                ->constrained('totem_models');

            $table->string('order_number');

            $table->string('serial_number');

            $table->foreignId('created_by')
                ->constrained('users');

            $table->foreignId('sector_id')
                ->constrained('sectors');

            $table->foreignId('assigned_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('priority')
                ->default('medium');

            $table->string('status')
                ->default('open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurrences');
    }
};
