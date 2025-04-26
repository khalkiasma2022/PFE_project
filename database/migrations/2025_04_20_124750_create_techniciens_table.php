<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('techniciens', function (Blueprint $table) {
            $table->string('Matricule_tech', 50)->primary();
            $table->string('Nom_tech', 100);
            $table->string('Email_tech', 100)->nullable();
            $table->string('Mot_de_passe_tech');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('techniciens');
    }
};