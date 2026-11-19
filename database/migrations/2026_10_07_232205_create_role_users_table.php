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
        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('role_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0)->index('role_user_user_id_foreign');

            $table->index(['role_id', 'user_id'], 'admin_role_user_role_id_user_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_users');
    }
};
