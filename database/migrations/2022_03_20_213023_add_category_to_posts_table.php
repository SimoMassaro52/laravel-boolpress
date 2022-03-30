<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')
            //Diamo a questa foreign la possibilità di essere nullo dato che la tabella è vuota
            ->nullable()
            //Constrained è la versione abbreviata dei riferimenti alla tabella primaria della nostra tabella secondaria
            ->constrained()
            //Dobbiamo permettere al nostro amministratore con i permessi di eliminare la categoria che, avendo una foreign key collegata ad un post, esso dovrà perderla. onDelete('set null') rende nulla proprio questa su tutti i post contenenti la categoria 
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //"Rimuoviamo la relazione" dalla colonna che sarà rimossa sganciandola dalla tabella
            $table->dropForeign(['category_id']);
            //Cancelliamo la tabella
            $table->dropColumn('category_id');
        });
    }
}
