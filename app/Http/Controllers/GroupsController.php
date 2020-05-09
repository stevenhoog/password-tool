<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Group;
use App\Users;

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

    // Go to view to add a new group
    public function add()
    {
    	return view('addGroup');
    }

    // Handle post request to create new group
    public function create(Request $request)
    {
    	$group = new Group();
    	$group->name = $request->name;
    	$group->description = $request->description;
    	$group->user_id = Auth::id();
    	$group->save();
    	return redirect(RouteServiceProvider::HOME);
    }

    // Go to view to edit a group
    public function edit(Group $group) 
    {

        // Only the user that created the task can edit it
        if (Auth::user()->id == $group->user_id) {
            // Get a list of all of the application's users
            $users = Users::all();
            return view('editGroup', compact('group', 'users'));
        } else {
            return redirect(RouteServiceProvider::HOME);
        }

    }

    // Handle post request to update group
    public function update(Request $request, Group $group)
    {
        if (isset($_POST['delete'])) {
            $group->delete();
            return redirect(RouteServiceProvider::HOME);

        } else {
            // Update group
            $group->name = $request->name;
            $group->description = $request->description;
            $group->save();

            // Add group to user model
            if ($request->has('users')) {

                foreach($request->users as $userSelect) {
                    // Retrieve user model by its primary key
                    $user = Users::find($userSelect);
                    
                    $user->group = $group->id;
                    $user->save();
                }
            }

            return redirect(RouteServiceProvider::HOME);
        }
    }

}
