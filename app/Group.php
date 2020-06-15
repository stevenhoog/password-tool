<?php

namespace App;
use App\User;
use App\Login;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // The table associated with the model
    protected $table = 'groups';

    // The attributes that are mass assignable
    protected $fillable = ['user_id', 'name', 'description'];

    public function user() 
    {
    	return $this->belongsToMany(User::class);
    }

    public function logins()
    {
    	return $this->hasMany(Login::class);
    }
}
