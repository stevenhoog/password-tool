<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
	// Only authenticated users have access to the profile
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show()
    {
    	$user = Auth::user();
    	return view('profile', compact('user'));
    }
}
