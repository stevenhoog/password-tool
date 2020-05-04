<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // The table associated with the model
    protected $table = 'groups';

    public function user() 
    {
    	return $this->belongsTo(User::class);
    }
}
