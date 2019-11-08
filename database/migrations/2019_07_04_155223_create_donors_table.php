<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {

      
                $table->bigIncrements('id');
                $table->string('d_user_id')->unique();
                $table->string('name');
                $table->date('dob');
                $table->unsignedBigInteger('sex_id');
                $table->unsignedBigInteger('blood_group_id');
                $table->unsignedBigInteger('prescription_id');
                $table->tinyinteger('status')->default(0);
                $table->integer('admin_id')->unsigned();
                $table->timestamps();
                $table->foreign('sex_id')
                    ->references('id')->on('sexes')
                    ->onDelete('cascade');
                $table->foreign('blood_group_id')
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
        Schema::dropIfExists('donors');
    }
}
