<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Users;

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

        // Decrypt password to show it in the profile view 
        try {
            $password = decrypt($user->password);
        } catch (DecryptException $e) {
            //
        }

    	return view('profile', compact('user', 'password'));
    }

    public function update(Request $request)
    {
        // Get the currently authenticated user's ID
        $id = Auth::id();

        // Retrieve user model by its primary key
        $user = Users::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Encrypt user's password 
        $user->password = encrypt($request->password);
        $user->save();

        return redirect(RouteServiceProvider::HOME);

    }
}
