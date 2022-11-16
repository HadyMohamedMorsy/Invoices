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
        Schema::create('catagories', function (Blueprint $table) {
            $table->id();
            $table->string('name_cat' , 50);
            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->string('image_name');
            $table->unsignedBigInteger('translation_id')->index();
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
        Schema::dropIfExists('catagories');
    }
};
