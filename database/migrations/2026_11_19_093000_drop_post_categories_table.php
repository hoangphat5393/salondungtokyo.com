<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop legacy post_categories table and clean up post-type categories (aligned with vattunongnghiep58 & 3nong).
     */
    public function up(): void
    {
        Schema::dropIfExists('post_categories');

        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'type')) {
            DB::table('categories')->where('type', 'post')->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('post_categories')) {
            Schema::create('post_categories', function (Blueprint $table): void {
                $table->integer('post_id');
                $table->integer('category_id');
                $table->primary(['post_id', 'category_id']);
            });
        }
    }
};
