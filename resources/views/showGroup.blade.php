@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ ucfirst($group->name) }} Logins</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">
                          <a href="{{ route('logins.create', ['group'=>$group->id]) }}" class="btn btn-primary">Add new Login</a>
                        </div>
                        <div class="col-md-4">
                          <form action="/group/{{ $group->id }}}" class="d-inline">
                            <div class="input-group">
                              <input type="text" name="search" placeholder="Search Logins" class="form-control">
                              <div class="input-group-append">
                                <div class="input-group-text p-0">
                                  <button type="submit" class="btn btn-sm"><span class="fa fa-search" aria-hidden="true"></span></button>
                                </div>
                              </div>
                            </div>
                            {{ csrf_field() }}
                          </form>
                        </div>
                      </div>

                        @if(!$logins->isEmpty())
                        <table class="table mt-4">
                             <thead>
                                <tr>
                                  <th scope="col" class="border-top-0">Title</th>
                                  <th scope="col" class="border-top-0">Username</th>
                                  <th scope="col" class="border-top-0">Password</th>
                                  <th scope="col" class="border-top-0"></th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach($logins as $login)
                                <tr>
                                  <td><input type="text" name="title" class="form-control-sm form-control-plaintext" readonly value="{{$login->title}}"></td>
                                  <td><input type="text" name="username" class="form-control-sm form-control-plaintext" readonly value="{{$login->username}}"></td>
                                  <td>
                                    <div class="input-group">

                                        <input type="password" name="password" class="form-control-sm form-control-plaintext" readonly value="{{decrypt($login->password)}}">
                                        <div class="input-group-append">
                                            <div class="input-group-text p-0 rounded">
                                                <button type="button" class="btn btn-sm pt-0 showPassword"><i class="fa fa-eye text-dark mt-2" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="align-middle">
                                        <form action="/logins/{{$login->id}}/edit" class="d-inline">
                                            <button type="submit" name="edit" title="Edit" class="btn btn-sm btn-outline-primary"><span class="fa fa-edit fa-lg" aria-hidden="true"></span></button>
                                            <input type="hidden" name="group" value="{{ $group->id }}">
                                            {{ csrf_field() }}
                                        </form>
                                        <form method="post" action="/logins/{{$login->id}}" class="d-inline">
                                             @method('DELETE')
                                            <button type="submit" name="delete" title="Delete" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash-o fa-lg" aria-hidden="true"></span></button>
                                            <input type="hidden" name="group" value="{{ $group->id }}">
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                             </tbody>
                        </table>
                        @else
                        <p class="mt-4">No logins found</p>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
