<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    
    /**
     * Gets Entries for a given account
     */
    protected $table = "entries";

    protected $primaryKey = 'entry_id';

    protected $fillable = [
    	'user', 
    	'amount', 
    	'type', 
    	'description',
    	'account',
    	'made_on'
    ];

    

}
