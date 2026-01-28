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
      Schema::create('invoice_files', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('invoice_id'); // link to invoices
    $table->string('filename');
    $table->string('path');
    $table->timestamps();

    // Foreign key constraint
    $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_files');
    }
};
