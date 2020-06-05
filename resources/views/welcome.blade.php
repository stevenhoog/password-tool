@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">Groups list</div>

                    <div class="card-body">
                        <a href="/group" class="btn btn-primary">Add new Group</a>
                        <table class="table mt-4">
                             <thead>
                                <tr>
                                    <th colspan="2" scope="col" class="border-top-0">Groups</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($user->groups as $group)
                                <tr>
                                    <td>
                                        <h4>{{$group->name}}</h4>
                                        <span>{{$group->description}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <form action="/group/{{$group->id}}" class="d-inline">
                                            @method('PUT')
                                            <button type="submit" name="edit" class="btn-sm btn-outline-primary">Edit</button>
                                            {{ csrf_field() }}
                                        </form>
                                        <form action="/group/{{$group->id}}" class="d-inline">
                                             @method('DELETE')
                                            <button type="submit" name="delete" formmethod="post" class="btn-sm btn-outline-danger">Delete</button>
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                             </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
