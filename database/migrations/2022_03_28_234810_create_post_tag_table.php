<?php

//!!!TABELLA PIVOT tra post e tag
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            //Le fk che ci interessano
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            //Con quel onDelete('cascade'), stiamo dicendo di eliminare il record una volta che uno dei due elementi della relazione viene cancellato
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('post_tag');
    }
}
