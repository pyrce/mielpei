<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdresseFacturation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse_facturation', function (Blueprint $table) {
            $table->id();
            $table->integer("commande_id");
            $table->integer("voie")->nullable();
            $table->string("rue")->nullable();
            $table->string("ville")->nullable();
            $table->string("pays")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresse_facturation');
    }
}
