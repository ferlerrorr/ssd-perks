<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function employeeClientRegister(Request $request)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'employee_id' => 'required|string|unique:employee',
            'card_id' => 'required|string',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'nullable|string',
            'company_code' => 'nullable|string',
        ]);

        try {
            // Insert the new employee into the database using validated data
            $employee = Employee::create($validatedData);

            return response()->json([
                'message' => 'Employee registered successfully!',
                'employee' => $employee
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred during registration: ' . $e->getMessage()
            ], 500);
        }
    }
}
