<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('contact_recruitment_id')->nullable();
            $table->unsignedBigInteger('cate_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('company_id');
            $table->dropColumn('position_id');
            $table->dropColumn('contact_recruitment_id')->nullable();
        });
    }
}
