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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('Invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('pay_month' , 5 ,2);
            $table->date('due_date');
            $table->string('status');
            $table->decimal('plus', 5 ,2)->default(0);
            $table->decimal('fine' , 5 ,2)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('installments');
    }
};
