<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Account;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountController extends Controller
{
   /**
     * Create a new account
     * @param request
     * @return void
     */
    function create(Request $request) {
    	$this->validate($request, [
    		'name'        => 'required|string',
    		'owner'       => 'required|string',
    		'description' => 'required|string',
    		'created_on'  => 'required|date'
    	]);

    	try {
    		Account::create($request->only(['name', 'owner', 'description', 'created_on']));	
    	} catch (QueryException $exception) {
    		return response()->json(["error" => "Account already exists"], 403);
    	}
    	
    	$response = [
    		"status" => "ok"
    	];
    	return response()->json($response, 200);
    }

    /**
     * update account information
     * @param request
     */
    function update(Request $request) {
    	$this->validate($request, [
    		'user'        => 'required | string',
    		'debit'       => 'boolean',
    		'credit'      => 'boolean',
    		'amount'      => 'required | integer',
    		'created_on'  => 'required | date',
    		'description' => 'required | string'
    	]);

    	$response = [
    		"status"  => "ok"
    	];
        //
        // TODO
        //
    	return response()->json($response, 200);
    }

    /**
     * Make entry 
     * @param accountName
     * @param op (operation, "d" for debit, "c" for credit)
     */
    function makeEntry(Request $request, $accountName, $op, $type) {

        // Validations
        // -----------

        $this->validate($request, [
            "token"       => "string",
            "to"          => "required | string",
            "amount"      => "required | integer",
            "description" => "required | string",
            "made_on"     => "required | date"
        ]);

       if (!Account::accountExists($accountName)){
            return response()->json(["error" => "Account does not exists"], 300);
        }        

        // Insertions
        // ----------
        // Each transaction involves two entries, one for debit
        // and other for credit. 
        $currentUser = Auth::user();
        $entry1 = [
            "user"        => $currentUser["name"],
            "amount"      => $request->get("amount"),
            "type"        => !strcmp($op, "d") ? "debit" : "credit",
            "description" => $request->get("description"),
            "account"     => $accountName,
            "made_on"     => $request->get("made_on"),
        ];

        $entry2 = [
            "user"        => $accountName,
            "amount"      => $request->get("amount"),
            "type"        => !strcmp($op, "d") ? "credit" : "debit",
            "description" => $request->get("description"),
            "account"     => $currentUser["name"],
            "made_on"     => $request->get("made_on"),
        ];

        try {
            Entry::create($entry1);
            Entry::create($entry2);
            $temp = Entry::orderBy('id', 'desc')->take(2)->get();
            $q1 = $temp[0];
            $q2 = $temp[1];
            
            $transaction = [
                "from" => !strcmp($op, "d") ? $currentUser['name'] : $accountName,
                "to" => !strcmp($op, "d") ? $accountName : $currentUser['name'],
                "from-id" => !strcmp($op, "d") ? $q1['id'] : $q2['id'],
                "to-id" => !strcmp($op, "d") ? $q2['id'] : $q1['id'],
                "type" => $type,
                "made_on" => $request->get("made_on"),
                "amount" => $request->get("amount"),
                "description" => $request->get("description")

            ];

            Transaction::create($transaction);

        } catch (QueryException $e) {
            return response()->json((array)$e, 402);
        }

        return response()->json($transaction, 200); 
        
    }
}
