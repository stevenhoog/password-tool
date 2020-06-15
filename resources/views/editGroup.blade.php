@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit the Group</div>
                <div class="card-body">
                    <form method="post" action="/group/{{ $group->id }}">
                        @method('PUT')
                        <div class="form-group">
                            <label for="users">Users added to this group</label>
                            <select name="users[]" class="form-control" multiple>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->groups->contains($group->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $group->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $group->description }}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Edit Group</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
