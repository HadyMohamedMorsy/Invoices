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
        Schema::create('Invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number_invoice');
            $table->string('status' , 20);
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type' , 30);
            $table->decimal('total_invoice');
            $table->decimal('total');
            $table->integer('tax')->default(5);
            $table->decimal('presenter')->nullable();
            $table->integer('years')->nullable();
            $table->decimal('total_pay')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
