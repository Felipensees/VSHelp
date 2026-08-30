<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('occurrence_histories', function (Blueprint $table) {
    $table->id();

    $table->foreignId('occurrence_id')
        ->constrained('occurrences')
        ->cascadeOnDelete();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->string('action');

    $table->enum('from_status', [
        'open',
        'in_progress',
        'resolved',
        'closed',
    ])->nullable();

    $table->enum('to_status', [
        'open',
        'in_progress',
        'resolved',
        'closed',
    ])->nullable();

    $table->text('description')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurrence_histories');
    }
};
