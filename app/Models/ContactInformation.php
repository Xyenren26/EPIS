<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    // Define the table name (if it's different from the plural form of the model name)
    protected $table = 'contact_information';

    // Specify the fillable attributes
    protected $fillable = [
        'header',           // Title of the section (e.g., Emergency Services)
        'department',       // Department or office name
        'head_or_officer',  // Dept. Heads/Chiefs of Offices/Officers-in-Charge
        'tel_no',           // Telephone number
        'local_no',         // Local number
        'floor',            // Floor or building location
        'image_path',       // Path to the image file
    ];

    // Optionally, you can set any default values for attributes here
    protected $attributes = [
        'tel_no' => null,
        'local_no' => null,
        'floor' => null,
        'image_path' => null,
    ];
}
