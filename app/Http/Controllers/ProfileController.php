<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
	// Only authenticated users have access to the profile
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show()
    {
    	return view('profile');
    }
}
