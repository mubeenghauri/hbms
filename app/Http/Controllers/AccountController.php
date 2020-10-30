<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
   /**
     * Create a new account
     * @param request
     * @return void
     */
    function create(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|string',
    		'owner' => 'required|string',
    		'description' => 'required|string',
    		'created_on' => 'required|date'
    	]);

    	try {
    		Account::create($request->only(['name', 'owner', 'description', 'created_on']));	
    	} catch (QueryException $exception) {
    		return response()->json(["error" => "User already exists"], 403);
    	}
    	
    	$response = [
    		"status" => "ok"
    	];
    	return response()->json($response, 200);
    }

    /**
     * Make entry into an account (update account)
     * @param request
     */
    function update(Request $request) {
    	$this->validate($request, [
    		'user' => 'required | string',
    		'debit' => 'boolean',
    		'credit' => 'boolean',
    		'amount' => 'required | integer',
    		'created_on' => 'required | date',
    		'description' => 'required | string'
    	]);

    	$response = [
    		"status"  => "ok"
    	];
    	return response()->json($response, 200);
    }
}
