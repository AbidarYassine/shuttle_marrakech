<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChauffeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', '20');
            $table->string('prenom', '20');
            $table->string('email', '100')->default('null');
            $table->string('password', '200')->default('null');
            $table->boolean('active')->default(false);// autorisation pour cree des ofres
            $table->string('telephone', 15);
            $table->string('address', '50');
            $table->string('typePermi', '1');
            $table->integer('categorie_id')->unsigned();
            $table->string('numeroPermi', '30')->unique();
            $table->string('image', '200');
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
        Schema::dropIfExists('chauffeurs');
    }
}
