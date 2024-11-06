<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketingTable extends Model
{
    use HasFactory;

    protected $table = 'Ticketing_table';
    protected $primaryKey = 'EmployeeID';
    public $incrementing = true;
    protected $fillable = [
        'fname',
        'lname',
        'Department',
        'Concern',
        'Remarks',
        'Technical_Supported',
        'TimeIn',
        'TimeOut'
    ];
}
