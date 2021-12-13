<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('applicants', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->timestamp('birthday');
            $table->text('address');
            $table->string('expected_salary');
            $table->timestamp('start_date')->nullable();
            $table->text('resume')->nullable();
            $table->string('website')->nullable();
            $table->text('experience')->nullable();
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('applicants');
    }
}
