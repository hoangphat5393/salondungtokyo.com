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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id')->index('menu_items_menu_id_foreign');
            $table->text('slug')->nullable();
            $table->string('label')->nullable();
            $table->text('link')->nullable();
            $table->text('image')->nullable();
            $table->mediumText('content')->nullable();
            $table->unsignedInteger('parent')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->integer('depth')->default(0);
            $table->timestamps();
            $table->string('rel', 10)->nullable()->default('dofollow');
            $table->string('target', 10)->nullable()->default('_self');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
