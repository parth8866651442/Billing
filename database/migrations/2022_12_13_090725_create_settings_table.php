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
        Schema::create('settings', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('prefix_name_invoice')->nullable();
            $table->string('bd_holdare_name')->nullable();
            $table->string('bd_bank_name')->nullable();
            $table->string('bd_ifsc_code')->nullable();
            $table->string('bd_account_no')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email_id')->nullable();
            $table->longText('terms_conditions')->nullable();
            $table->string('sign_img')->nullable();
            $table->string('logo_img')->nullable();
            $table->string('favicon_img')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
