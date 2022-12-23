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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->double('amount', 8, 2)->default(00.00);
            $table->double('due_amount', 8, 2)->default(00.00);
            $table->double('paid_amount', 8, 2)->default(null);
            $table->enum('payment_type', ['cash','cheque','online'])->default('cash');
            $table->string('transaction_no')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_date')->nullable();
            $table->longText('note')->nullable();
            $table->string('date')->nullable();
            $table->integer('create_by');
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
