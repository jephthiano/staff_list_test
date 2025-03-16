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
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        //for company
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable()->nullable();
            $table->text('address')->nullable();;
            $table->uuid('company_category_id'); // Ensure it's a UUID
            $table->foreign('company_category_id')->references('id')->on('company_categories')->onDelete('cascade');
            $table->timestamps();
        });


        //for staffs
        Schema::create('staff', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->decimal('wallet', 10, 2)->default(0.00);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('last_seen')->nullable();
            $table->boolean('manage')->default(false);
            $table->uuid('company_id'); // Foreign key to companies

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('staff');
    }
};
