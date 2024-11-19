<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketingTable extends Model
{
    use HasFactory;

    protected $table = 'Ticketing_table';  // Make sure this is the correct table name
    protected $primaryKey = 'control_no';  // Set the primary key to 'control_no'
    public $incrementing = false;  // 'control_no' is not auto-incremented
    protected $keyType = 'string';  // Assuming 'control_no' is a string

    // Correct the typo in 'unique' and ensure it's properly referenced if needed
    // You could add a 'unique' constraint in the migration or validation logic rather than in the model directly

    protected $fillable = [
        'control_no',   // Add 'control_no' to the fillable array
        'fname',         // Ensure column names match those in the database
        'lname',
        'Department',
        'Concern',
        'Remarks',
        'Technical_Supported',
        'TimeIn',
        'TimeOut',
        'Status'
    ];

    // Define any relationships or custom methods if necessary

    public function technicalSupport()
    {
        return $this->belongsTo(AccountTable::class, 'Technical_Supported', 'EmployeeID');
    }
}
