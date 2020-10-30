<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    
    /**
     * Gets Entries for a given account
     */

    protected $primaryKey = 'entry_id';

    protected $fillable = [
    	'user', 
    	'debit', 
    	'credit', 
    	'description',
    	'account',
    	'made_on'
    ]

    

}
