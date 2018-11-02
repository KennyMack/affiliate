<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyname', 120);
            $table->string('cnpjcpf', 40)->nullable();
            $table->tinyInteger('status')->default(1); // 0- inativo 1- ativo
            $table->integer('city_id')->nullable()->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('street', 120)->nullable();
            $table->string('district', 120)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('postalnumber', 15)->nullable();
            $table->string('logopath', 255)->nullable();
            $table->string('logourl', 255)->nullable();
            $table->string('phone', 60)->nullable();
            //$table->string('occupation_area', 60)->nullable();
            //$table->string('expertise', 60)->nullable();

            // area de ocupação
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            // especialidade
            $table->integer('expertise_id')->nullable()->unsigned();
            $table->foreign('expertise_id')->references('id')->on('categories');

            $table->string('details', 255)->nullable();
            $table->integer('starttime')->nullable();
            $table->integer('endtime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
