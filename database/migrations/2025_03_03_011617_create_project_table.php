<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('project_name');
            $table->string('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });

        Schema::create('project_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('module_name');
            $table->string('color')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('deleted')->default(false);
            $table->foreignUlid('project_id')->constrained('projects')->onDelete('cascade');
        });

        Schema::create('project_tasks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->foreignUuid('module_id')->nullable()->constrained('project_modules')->onDelete('set null');
            $table->boolean('deleted')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->foreignUlid('project_id')->constrained('projects')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tasks_assignees', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('task_id')->constrained('project_tasks')->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_assignees');
        Schema::dropIfExists('project_tasks');
        Schema::dropIfExists('project_modules');
        Schema::dropIfExists('projects');
    }
};
