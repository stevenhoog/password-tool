<?php

namespace App;
use App\User;
use App\Group;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

    // The attributes that are mass assignable
    protected $fillable = ['title', 'username', 'password'];

    public function user() 
    {
    	return $this->belongsTo(User::class);
    }

    public function group()
    {
    	return $this->belongsTo(Group::class);
    }
}
