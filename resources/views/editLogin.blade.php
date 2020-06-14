@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Login</div>
                <div class="card-body">
                    <form method="post" action="/logins/{{$login->id}}">
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{$login->title}}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="{{$login->username}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" value="{{decrypt($login->password)}}">
                                    <div class="input-group-append">
                                        <div class="input-group-text p-0">
                                            <button type="button" class="btn pt-0 showPassword"><i class="fa fa-eye text-dark mt-2" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Login</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
