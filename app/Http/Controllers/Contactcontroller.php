<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;

class Contactcontroller extends Controller
{
    public function showContact()
    {
        return view('contact');
    }

    public function saveContact(Request $request)
    {
        $validated = $request->validate([
            'header' => 'required|string',
            'department' => 'nullable|string',
            'head_or_officer' => 'nullable|string',
            'tel_no' => 'nullable|string',
            'local_no' => 'nullable|string',
            'floor' => 'nullable|string',
        ]);

        // Save to database
        $contact = ContactInformation::updateOrCreate(
            ['department' => $validated['department']], // Assuming unique department name, adjust as needed
            $validated
        );

        return response()->json(['success' => true]);
    }
}
