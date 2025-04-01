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
        Schema::create("test_type", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean('is_custom')->default(true);
        });

        Schema::create("test_status", function (Blueprint $table) {
            $table->id();
            $table->string("status");
        });

        Schema::create('test_cases', function (Blueprint $table) {
            $table->Ulid('id')->primary();
            $table->string('descriptive_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('steps');
            $table->text('obtained_result');
            $table->text('test_comments')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->float('duration_in_seconds')->nullable();
            $table->string('test_version')->nullable();
            $table->text('pre_conditions')->nullable();
            $table->boolean('is_automated')->nullable();
            $table->boolean('deleted')->default(false);

            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignUlid('requirement_id')->nullable()->constrained('project_requirements')->onDelete('cascade');
            $table->foreignId('test_type')->nullable()->constrained('test_type')->onDelete('set null');            
            $table->foreignId('test_status')->nullable()->constrained('test_status')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('test_cases');
        Schema::dropIfExists('test_status');
        Schema::dropIfExists('test_type');
        
    }
};
