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
        Schema::create('permissions_masters', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->integer('panel_id');
            $table->integer('module_id');
            $table->string('view')->default(1);
            $table->string('edit')->default(1);
            $table->string('add')->default(1);
            $table->string('delete')->default(1);
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
        Schema::dropIfExists('permissions_masters');
    }
};
