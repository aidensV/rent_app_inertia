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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("item_id");
            $table->date("trx_date");
            $table->string("name");
            $table->string("dosen_nip")->nullable();
            $table->string("dosen_name")->nullable();
            $table->string("course")->nullable();
            $table->time("start_time");
            $table->time("end_time")->nullable();
            $table->enum("status",["waiting","approved","finished","canceled"])->default("waiting");
            $table->string("description")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions',function(Blueprint $table){
            $table->dropForeign('transaction_user_id_foreign');
            $table->dropForeign('transaction_item_id_foreign');
        });
    }
};
