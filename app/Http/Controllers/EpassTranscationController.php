<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EPassTransaction;

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
    public function getLatestTransactions()
    {
        // Retrieve the latest 500 transactions sorted by the created_at column in descending order
        $transactions = EPassTransaction::orderBy('created_at', 'desc')
            ->limit(500)
            ->get();

        // Return the results as JSON
        return response()->json($transactions, 200);
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
}
