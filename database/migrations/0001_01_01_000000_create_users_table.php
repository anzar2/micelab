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

        Schema::create('themes', function (Blueprint $table) {
            $table->string('code')->primary();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('name');
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->integer('code')->primary();
            $table->string('name');
        });

        Schema::create("user_preferences", function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('theme')->nullable();
            $table->foreign('theme')->references('code')->on('themes')->onDelete('set null');

            $table->string('language')->nullable();
            $table->foreign('language')->references('code')->on('languages')->onDelete('set null');

            $table->integer('timezone')->nullable();
            $table->foreign('timezone')->references('code')->on('timezones')->onDelete('set null');
        });

        Schema::create("user_roles", function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->boolean("can_create_project");
            $table->boolean("can_delete_project");
            $table->boolean("can_manage_users");
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('user_preferences')->nullable()->constrained('user_preferences')->onDelete('set null');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('deleted')->default(false);
            $table->foreignId('role_id')->nullable()->constrained('user_roles')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('timezones');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
