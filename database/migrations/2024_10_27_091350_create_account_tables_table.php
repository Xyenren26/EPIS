<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_tables', function (Blueprint $table) {
            $table->string('EmployeeID')->primary(); // Set EmployeeID as the primary key
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Suffix')->nullable(); // Optional field
            $table->date('BirthDate');
            $table->integer('Age');
            $table->enum('Gender', ['Male', 'Female', 'Others']); // Limited to specified values
            $table->string('Address');
            $table->string('PhoneNumber');
            $table->string('Email')->unique(); // Unique email
            $table->binary('ProfilePicture')->nullable(); // BLOB for the profile picture
            $table->enum('AccountType', ['Technical-Admin', 'Technical-Support', 'Employee']); // Limited to specified values
            $table->string('Username')->unique(); // Unique username
            $table->string('Password'); // Password should be hashed before saving
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_tables');
    }
};
