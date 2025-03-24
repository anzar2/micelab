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
        Schema::create('bug_report_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->timestamps();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignUlid('bug_report_id')->references('id')->on('bug_reports')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('bug_report_comments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug_report_comments');
    }
};
