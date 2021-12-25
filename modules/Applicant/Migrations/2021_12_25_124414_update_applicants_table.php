<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApplicantsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('applicants', function (Blueprint $table) {
            $table->text('file')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->dropColumn('expected_salary');
            $table->dropColumn('start_date');
            $table->dropColumn('resume');
            $table->dropColumn('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('post_id');
            $table->dropColumn('position_id');
            $table->string('expected_salary')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->text('resume')->nullable();
            $table->string('website')->nullable();
        });
    }
}
