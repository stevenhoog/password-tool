<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Login;

class LoginsController extends Controller
{

    // Only authenticated users have access to their login credentials
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $logins = Auth::user()->logins;
        return view('profile', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addLogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create login in relation to the user model
        $login = Auth::user()->logins()->create([
            'title' => $request->title,
            'username' => $request->username,
            'password' => encrypt($request->password)
        ]);

        return redirect(RouteServiceProvider::PROFILE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        // Only the user that created the login can edit it
        if (Auth::user()->id == $login->user_id) {
            return view('editLogin', compact('login'));
        } else {
            return redirect(RouteServiceProvider::PROFILE);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        $login->title = $request->title;
        $login->username = $request->username;
        $login->password = encrypt($request->password);
        $login->save();

        return redirect(RouteServiceProvider::PROFILE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        // Only the user that created the login can delete it
        if (Auth::user()->id == $login->user_id) {
            $login->delete();
        }

        return redirect(RouteServiceProvider::PROFILE);
    }
}
