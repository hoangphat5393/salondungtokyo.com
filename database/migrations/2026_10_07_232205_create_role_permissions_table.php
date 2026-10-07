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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('role_id')->default(0);
            $table->unsignedBigInteger('permission_id')->default(0)->index('role_permisstion_permisstion_id_foreign');

            $table->index(['role_id', 'permission_id'], 'admin_role_permission_role_id_permission_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
