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
        //for user
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID as primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('is_admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // for company_categories
        Schema::create('company_categories', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID as primary key
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        //for company
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Use UUID as primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignUuid('company_category_id')->constrained()->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('company_categories');
        Schema::dropIfExists('companies');
    }
};
