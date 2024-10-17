<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EPassTransaction;
use App\Models\EPass;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EpassTranscationController extends Controller
{


    public function storeTransaction(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'cashier_id'       => 'required|string|max:100',
            'employee_id'       => 'required|string|max:100',
            'card_id'           => 'required|string|max:100',
            'employee_ar'       => 'required|numeric',
            'employee_ca'       => 'required|numeric',
            'transaction_type'  => 'required|string|max:50',
            'transaction_code'  => 'required|string|max:50|unique:e_pass_transaction',
            'pos_rec_no'        => 'required|string|max:50',
            'amount'            => 'required|numeric',
            'terminal_id'       => 'required|string|max:100',
            'store_code'        => 'required|string|max:100',
        ]);

        // Create a new EPassTransaction instance
        $ePassTransaction = EPassTransaction::create([
            'cashier_id'       => $validatedData['cashier_id'],
            'employee_id'       => $validatedData['employee_id'],
            'card_id'           => $validatedData['card_id'],
            'employee_ar'       => $validatedData['employee_ar'],
            'employee_ca'       => $validatedData['employee_ca'],
            'transaction_type'  => $validatedData['transaction_type'],
            'transaction_code'  => $validatedData['transaction_code'],
            'pos_rec_no'        => $validatedData['pos_rec_no'],
            'amount'            => $validatedData['amount'],
            'terminal_id'       => $validatedData['terminal_id'],
            'store_code'        => $validatedData['store_code'],
        ]);

        // Return a response indicating success
        return response()->json([
            'message' => 'Transaction created successfully',
            'data'    => $ePassTransaction
        ], 201);
    }



    /**
     * Retrieve the latest 500 EPassTransaction records, sorted by newest.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLatestTransaction($card_id)
    {
        // Get the current date
        $date = Carbon::now();

        $transactions = DB::table('e_pass_transaction')
            ->select('transaction_type', DB::raw('SUM(amount) as total'))
            ->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->where('is_void', 0)
            ->where('card_id', $card_id)
            ->groupBy('transaction_type')
            ->get();

        $deducted_ar = $transactions[0]->total;
        $deducted_ca = $transactions[1]->total;


        $epass = EPass::select('employee_ca', 'employee_ar')->where('card_id', $card_id)->get();
        $ar = $epass[0]->employee_ar;
        $ca = $epass[0]->employee_ca;


        $response = [
            'card_id' => $card_id,
            'total_ar' => $ar - $deducted_ar,
            'total_ca' => $ca - $deducted_ca,
        ];

        // Return the transactions in a JSON response
        return response()->json($response, 200);
    }




    /**
     * Update the is_void field to 1 for the given transaction_code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function voidTransaction(Request $request)
    {
        // Validate the request to ensure transaction_code is present
        $validatedData = $request->validate([
            'transaction_code' => 'required|string|max:50',
        ]);

        // Find the transaction by transaction_code
        $transaction = EPassTransaction::where('transaction_code', $validatedData['transaction_code'])->first();

        // Check if transaction exists
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update the is_void field to 1
        $transaction->is_void = 1;
        $transaction->save();

        // Return a success message
        return response()->json([
            'message' => 'Transaction voided successfully',
            'data' => $transaction
        ], 200);
    }



    // Function to handle the registration process
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'employee_id' => 'required|string|max:255',
            'card_id'     => 'required|string|max:255|unique:e_pass,card_id',  // Ensure card_id is unique
            'employee_ar' => 'required|numeric',
            'employee_ca' => 'required|numeric',
        ]);

        try {
            // Create a new EPass record
            $ePass = EPass::create([
                'employee_id' => $validatedData['employee_id'],
                'card_id'     => $validatedData['card_id'],
                'employee_ar' => $validatedData['employee_ar'] ?? null,  // If not provided, set to null
                'employee_ca' => $validatedData['employee_ca'] ?? null,
            ]);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'E-Pass registered successfully!',
                'data'    => $ePass
            ], 201);
        } catch (\Exception $e) {
            // Return error response in case of any exception
            return response()->json([
                'success' => false,
                'message' => 'Failed to register E-Pass.',
                'error'   => $e->getMessage()
            ], 500);
        }
    } // Function to handle the registration process
    public function getallTransacionsbyMonth()
    {
        // Get the current date
        $date = Carbon::now();

        $transactions =  EPassTransaction::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)->get();

        return response($transactions);
    }
}
