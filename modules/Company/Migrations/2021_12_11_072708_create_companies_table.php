<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('companies', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('logo')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('career_id');
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
        Schema::dropIfExists('companies');
    }
}
