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
        Schema::create('inspection_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('totem_inspection_id')
                ->constrained('totem_inspections')
                ->cascadeOnDelete();
            $table->foreignId('inspection_item_id')
                ->constrained('inspection_items')
                ->cascadeOnDelete();
            $table->enum('result', [
                'ok',
                'na',
            ]);
            $table->timestamps();
            $table->unique([
                'totem_inspection_id',
                'inspection_item_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_answers');
    }
};
