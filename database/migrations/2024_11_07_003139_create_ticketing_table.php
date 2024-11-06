<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ticketing_table', function (Blueprint $table) {
            $table->id('EmployeeID'); // Primary key
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->string('Department', 100)->nullable();
            $table->string('Concern', 255)->nullable();
            $table->text('Remarks')->nullable();
            $table->string('Technical_Supported', 100)->nullable();
            $table->dateTime('TimeIn')->nullable();
            $table->dateTime('TimeOut')->nullable();
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
        Schema::dropIfExists('Ticketing_table');
    }
}
