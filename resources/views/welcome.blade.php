@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">Groups list</div>

                    <div class="card-body">
                        <a href="{{ route('group.create') }}" class="btn btn-primary">Add new Group</a>

                        @if(!$groups->isEmpty())
                        <table class="table mt-4">
                             <thead>
                                <tr>
                                    <th colspan="2" scope="col" class="border-top-0">Groups</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($groups as $group)
                                <tr>
                                    <td>
                                        <h4>{{$group->name}}</h4>
                                        <span>{{$group->description}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <form action="/group/{{$group->id}}/edit" class="d-inline">
                                             <button type="submit" name="edit" title="Edit" class="btn btn-sm btn-outline-primary"><span class="fa fa-edit fa-lg" aria-hidden="true"></span></button>
                                            {{ csrf_field() }}
                                        </form>
                                        <form method="post" action="/group/{{$group->id}}" class="d-inline">
                                             @method('DELETE')
                                             <button type="submit" name="delete" title="Delete" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash-o fa-lg" aria-hidden="true"></span></button>
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                             </tbody>
                        </table>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
