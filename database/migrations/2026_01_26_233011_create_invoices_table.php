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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
                 
             
                $table->text('summary');

                $table->string('business_name');
                $table->text('business_address');

                $table->integer('invoice_number');
                $table->date('invoice_date');
                $table->date('invoice_duedate');

                $table->float('amount_due');

                $table->string('client_name');
                $table->string('client_business')->nullable()->change();
                $table->text('client_business_address');
                $table->string('client_email');
                $table->string('client_phone');

                $table->string('reminders')->nullable();

                $table->float('sum');
                $table->float('vat');
                $table->float('other_vat');
                $table->float('transaction_fee')->default(0);
                $table->float('total');

                $table->string('vat_percent');
                $table->string('other_vat_percent');
                $table->string('tax_name');

                $table->text('note');

                $table->boolean('haspaid')->default(false);

                $table->string('ref')->nullable();

                $table->unsignedBigInteger('user_id');

             
                $table->integer('status')->default(0);

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
