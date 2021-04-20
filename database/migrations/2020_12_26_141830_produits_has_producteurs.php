<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProduitsHasProducteurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("produit_id");
            $table->unsignedInteger("producteur_id");
            $table->integer("prix");
            $table->integer("stock");
            $table->integer("totalvente");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_user');
    }
}
