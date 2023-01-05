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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->longText('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('pan_card_no', 15)->nullable();
            $table->string('aadhaar_card_no', 20)->nullable();
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
        Schema::dropIfExists('clients');
    }
};
