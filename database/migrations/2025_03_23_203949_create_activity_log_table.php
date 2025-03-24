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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->morphs('subject');
            $table->foreignUuid('by')->constrained('users')->onDelete('cascade');
            $table->timestamp('when')->useCurrent();
        });

        Schema::table('activity_log', function (Blueprint $table) {
            $table->string('subject_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
