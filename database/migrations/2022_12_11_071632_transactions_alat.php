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

        Schema::create('transactions_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date("trx_date");
            $table->enum("status", ["waiting", "approved", "finished", "canceled"])->default("waiting");
            $table->string("description")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('transactions_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactions_alat_id');
            $table->unsignedBigInteger('item_id');
            $table->string("description")->nullable();
            $table->integer("qty")->default(0);
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
        Schema::dropIfExists('transactions_alat', function (Blueprint $table) {
            $table->dropForeign('transaction_user_id_foreign');
        });
        Schema::dropIfExists('transactions_items', function (Blueprint $table) {
        });
    }
};
