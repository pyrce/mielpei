<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdresseLivraison extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse_livraison', function (Blueprint $table) {
            $table->id();
            $table->integer("commande_id");
            $table->integer("voie");
            $table->string("rue");
            $table->string("ville");
            $table->string("pays");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresse_livraison');
    }
}
