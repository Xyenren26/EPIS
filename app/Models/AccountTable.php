<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AccountTable extends Model
{
    protected $table = 'account_tables'; // Specify the table name

    protected $primaryKey = 'EmployeeID'; // Set the primary key to EmployeeID

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
