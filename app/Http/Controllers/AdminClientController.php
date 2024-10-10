<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminClientController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function adminClientRegister(Request $request)
    {
        // Validate input fields
        $request->validate([
            'employee_id' => 'required|string|unique:admin',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8'
        ]);

        // Password and confirm password check
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        if ($password !== $confirm_password) {
            return response()->json([
                'error' => 'Password and confirm password do not match. Please try again.'
            ], 400);
        }

        // Hash the password
        $hashedPassword = Hash::make($password);

        // Prepare the input data
        $adminData = $request->only(['employee_id']);
        $adminData['password'] = $hashedPassword;

        try {
            // Insert the new admin into the database
            $admin = Admin::create($adminData);

            return response()->json([
                'message' => 'Admin registered successfully!',
                'admin' => $admin
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred during registration: ' . $e->getMessage()
            ], 500);
        }
    }
}
