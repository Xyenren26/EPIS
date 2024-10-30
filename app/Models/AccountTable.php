<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Add this
use Illuminate\Notifications\Notifiable;

class AccountTable extends Authenticatable
{
    use Notifiable;

    protected $table = 'account_tables';
    protected $primaryKey = 'EmployeeID';
    protected $casts = [
        'EmployeeID' => 'string', // Ensure EmployeeID is treated as a string(only we inlcuded for employee id that has "-")
    ];
    protected $fillable = [
        'FirstName', 'LastName', 'Suffix', 'BirthDate', 'Age', 'Gender',
        'EmployeeID', 'Address', 'PhoneNumber', 'Email', 'ProfilePicture',
        'AccountType', 'Username', 'Password', 'remember_token', 'last_activity',
    ];

    protected $hidden = [
        'Password', // Hide the password attribute
    ];

    // Define the attribute as 'password' to let Auth recognize it
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
