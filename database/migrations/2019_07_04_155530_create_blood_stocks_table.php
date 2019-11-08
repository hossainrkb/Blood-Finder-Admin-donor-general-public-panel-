<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blood_id');
            $table->date('c_date');
            $table->date('e_date');
            $table->tinyinteger('status')->default(0);
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            $table->foreign('blood_id')
            ->references('id')->on('blood_groups')
            ->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_stocks');
    }
}
