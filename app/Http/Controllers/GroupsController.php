<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Group;

class GroupsController extends Controller
{
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
    	$group->created_by = Auth::id();
    	$group->save();
    	return redirect('/');
    }
}
