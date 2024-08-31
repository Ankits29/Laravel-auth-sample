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
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('cust_id', true);
            $table->string('cust_fname', 100)->nullable();
            $table->string('cust_email', 60)->nullable();
            $table->string('password', 250)->nullable();
            $table->string('cust_phone', 30)->nullable();
            $table->string('cust_DOB', 20)->nullable();
            $table->string('cust_address', 200)->nullable();
            $table->dateTime('cust_createdate')->useCurrent();
            $table->dateTime('cust_updatedate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
