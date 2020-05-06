@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @auth
                    <div class="card-header">Groups list</div>

                    <div class="card-body">
                        <a href="/group" class="btn btn-primary">Add new Group</a>
                        <table class="table">
                             <thead>
                                <tr>
                                    <th scope="col">Groups</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($user->groups as $group)
                                <tr>
                                    <td>
                                        <h2>{{$group->name}}</h2>
                                        <span>{{$group->description}}</span>
                                    </td>
                                    <td>
                                        <form action="/group/{{$group->id}}">
                                            <button type="submit" name="edit" class="btn-sm btn-outline-primary">Edit</button>
                                            <button type="submit" name="delete" formmethod="post" class="btn-sm btn-outline-danger">Delete</button>
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                             </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <h3>You need to log in. <a href="/login" title="Login">Click here to login</a></h3>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</div>
@endsection
