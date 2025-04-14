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
        Schema::create('test_cases_comments', function (Blueprint $table) {
            $table->id();
            $table->text('case_comment');
            $table->timestamps();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignUlid('test_case_id')->references('id')->on('test_cases')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('test_cases_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_case_comments');
    }
};
