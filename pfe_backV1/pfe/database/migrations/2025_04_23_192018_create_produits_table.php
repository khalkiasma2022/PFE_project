<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('ID_produit'); // équivalent à AUTO_INCREMENT
            $table->string('Nom_produit', 100);
            $table->text('information_produit');
            $table->integer('quantite_produit');
            $table->timestamps(); // optionnel mais recommandé
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
};