<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInformationTable extends Migration
{
    public function up()
    {
        Schema::create('contact_information', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('header'); // Column for the section title
            $table->string('department'); // Department/Office
            $table->string('head_or_officer'); // Dept. Heads/Chiefs of Offices/Officers-in-Charge
            $table->string('tel_no')->nullable(); // Telephone Number
            $table->string('local_no')->nullable(); // Local Number
            $table->string('floor')->nullable(); // Floor location
            $table->string('image_path')->nullable(); // Path for uploaded images
            $table->timestamps(); // Timestamps for created and updated
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_information');
    }
}
