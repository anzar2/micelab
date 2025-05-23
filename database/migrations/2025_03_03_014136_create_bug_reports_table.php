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
        Schema::create('bug_reports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('bug_title');
            $table->text('bug_description');
            $table->text('steps_to_reproduce');
            $table->timestamps();
            $table->foreignUlid('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignUlid('requirement_id')->nullable()->constrained('project_requirements')->onDelete('set null');
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug_reports');
    }
};
