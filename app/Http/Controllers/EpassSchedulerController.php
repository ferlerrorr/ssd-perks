<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EpassSchedule;

class EpassSchedulerController extends Controller

{
    public function updateSchedule(Request $request)
    {
        // Step 1: Validate the request data
        $validatedData = $request->validate([
            'admin_id' => 'required|string',
            'auto_reset_CA' => 'required|date',
            'auto_reset_AR' => 'required|date',
            'manual_reset_CA' => 'required|date_format:Y-m-d H:i:s',
            'manual_reset_AR' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Step 2: Set all 'is_active' to 0 (deactivate all)
        EpassSchedule::where('is_active', 1)->update(['is_active' => 0]);

        // Step 3: Create a new schedule with 'is_active' set to 1
        EpassSchedule::create([
            'admin_id' => $validatedData['admin_id'],
            'auto_reset_CA' => $validatedData['auto_reset_CA'],
            'auto_reset_AR' => $validatedData['auto_reset_AR'],
            'manual_reset_CA' => $validatedData['manual_reset_CA'],
            'manual_reset_AR' => $validatedData['manual_reset_AR'],
            'is_active' => 1, // Set the new record as active
        ]);

        // Step 4: Return a success response
        return response()->json([
            'message' => 'Schedule updated successfully!',
        ], 200);
    }
}
