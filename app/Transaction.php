<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = [
    	"from",
    	"to",
    	"from-id",
    	"to-id",
    	"type",
    	"amount",
    	"made_on",
    	"description"
    ];
}
