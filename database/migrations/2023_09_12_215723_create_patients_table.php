<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('sus', 20)->unique();
            $table->string('name', 250)->unique();
            $table->string('social_name', 250)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('birthday')->nullable();
            $table->string('rg', 50)->nullable();
            $table->string('cpf', 50)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('cellphone', 50)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('number', 6)->nullable();
            $table->string('complement', 50)->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('uf', 2)->nullable();
            $table->timestamps(2);
            $table->softDeletes('deleted_at', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
