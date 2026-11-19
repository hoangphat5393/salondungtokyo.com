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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('provider', 100)->nullable();
            $table->string('provider_id', 100)->nullable();
            $table->rememberToken();
            $table->integer('admin_level')->nullable()->default(1);
            $table->integer('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
