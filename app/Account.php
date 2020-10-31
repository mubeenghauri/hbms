<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'account_id';

    protected $fillable = ['name', 'owner', 'description', 'created_on'];

    /**
     * Verifies if an account exits in database
     * 
     * @param $account : string
     * @return true | false
     */
    static function accountExists($account) {
    	$acc = Account::where("name", $account)->get();
        $status = false;
    	sizeof($acc) == 0 ? $status =  false : $status =  true;
        return $status;
    }

}
