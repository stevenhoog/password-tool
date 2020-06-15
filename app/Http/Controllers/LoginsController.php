<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Login;
use App\Group;

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
    public function create(Request $request)
    {   
        // Determine if login need to be added to a group
        $group = [];
        if ($request->has('group')) {
            $group = Group::find($request->group);
        }

        return view('addLogin', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Determine if login should be in relation with the group model
        if ($request->has('group')) {
            $model = Group::find($request->group);
        } else {
            $model = Auth::user();
        }


        // Create login in relation to the user or group model
        $login = $model->logins()->create([
            'title' => $request->title,
            'username' => $request->username,
            'password' => encrypt($request->password)
        ]);

        // Show group when login is created within group
        if ($request->has('group')) {
            return redirect('/group/'.$request->group);
        } else {
            return redirect(RouteServiceProvider::PROFILE);
        }
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
    public function edit(Request $request, Login $login)
    {

        // Only the user with the right permissions can edit it
        if (Auth::user()->id == $login->user_id || ($request->has('group') && $request->group == $login->group_id)) {
            // Determine if login is edited within group
            $group = [];
            if ($request->has('group')) {
                $group = Group::find($request->group);
            }

            return view('editLogin', compact('login', 'group'));
        } else {
            
            if ($request->has('group')) {
            return redirect('/group/'.$request->group);
            } else {
                return redirect(RouteServiceProvider::PROFILE);
            }
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

        if ($request->has('group')) {
            return redirect('/group/'.$request->group);
        } else {
            return redirect(RouteServiceProvider::PROFILE);
        }
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

        if ($request->has('group')) {
            return redirect('/group/'.$request->group);
        } else {
            return redirect(RouteServiceProvider::PROFILE);
        }
    }
}
