<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Group;
use App\User;

class GroupsController extends Controller
{

    // Only authenticated users have access to the groups
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
    	return view('welcome', compact('user'));
    }

    // Return view to add a new group
    public function create()
    {
    	return view('addGroup');
    }

    // Handle post request to create new group
    public function store(Request $request)
    {
        // Create group in relation to the user model
        $user = Auth::user();

        $group = $user->groups()->create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user->id
        ]);

    	return redirect(RouteServiceProvider::HOME);
    }

    // Show login credentials of a group
    public function show(Group $group)
    {
        $logins = $group->logins;
        return view('showGroup', compact('logins', 'group'));
    }

    // Return view to edit a group
    public function edit(Group $group) 
    {

        // Only the user that created the group can edit it
        if (Auth::user()->id == $group->user_id) {
            // Get a list of all the application's users
            $users = User::all();
            return view('editGroup', compact('group', 'users'));
        } else {
            return redirect(RouteServiceProvider::HOME);
        }

    }

    // Handle post request to update group
    public function update(Request $request, Group $group)
    {
        // Update group
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        // Add group to user model
        if ($request->has('users')) {

            // Get a list of all the application's users
            $users = User::all();

            // Loop each user
            foreach($users as $user) {

                // Detach group to user, before attaching again
                $user->groups()->detach($group->id);

                if (in_array($user->id, $request->users)) {
                    // Attach group to user that is selected
                    $user->groups()->attach($group->id);
                } 
            }
        }
        
        return redirect(RouteServiceProvider::HOME);
    }

    // Delete group
    public function destroy(Group $group)
    {
         // Only the user that created the group can delete it
        if (Auth::user()->id == $group->user_id) {
            $group->delete();
        }

        return redirect(RouteServiceProvider::HOME);
    }

}
