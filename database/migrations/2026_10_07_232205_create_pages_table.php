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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('slug')->nullable();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('seo_title', 150)->nullable();
            $table->mediumText('seo_keyword')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->string('type', 50)->nullable()->comment('page | post');
            $table->integer('sort')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_id')->index('pages_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
