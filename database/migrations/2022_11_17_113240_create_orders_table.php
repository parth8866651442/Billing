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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('invoice_no');
            $table->string('fullname');
            $table->string('sip_vehicle_no');
            $table->string('moblie_no');
            $table->enum('type', ['duplicate', 'orignal'])->default('duplicate');
            $table->integer('create_by');
            $table->integer('update_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->string('is_active')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
