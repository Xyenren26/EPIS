<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountTable extends Model
{
    protected $table = 'account_tables'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'FirstName',
        'LastName',
        'Suffix',
        'BirthDate',
        'Age',
        'Gender',
        'EmployeeID',
        'Address',
        'PhoneNumber',
        'Email',
        'ProfilePicture',
        'AccountType',
        'Username',
        'Password',
    ];
}
