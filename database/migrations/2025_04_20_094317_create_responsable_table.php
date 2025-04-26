<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('responsable', function (Blueprint $table) {
            $table->string('Matricule_resp', 50)->primary();
            $table->string('Nom_resp', 100)->nullable(false);
            $table->string('Email_resp', 100)->nullable();
            $table->string('Mot_de_passe_resp', 255)->nullable(false);
            $table->rememberToken(); // Ajout recommandé pour "se souvenir de moi"
            $table->timestamps(); // Ajout recommandé pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('responsable');
    }
};