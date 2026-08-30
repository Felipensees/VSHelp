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
        Schema::table('occurrences', function (Blueprint $table) {
        $table->timestamp('started_at')->nullable()->after('status');
        $table->timestamp('resolved_at')->nullable()->after('started_at');
        $table->timestamp('closed_at')->nullable()->after('resolved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('occurrences', function (Blueprint $table) {
        $table->dropColumn([
            'started_at',
            'resolved_at',
            'closed_at',
        ]);
    });
}
};
