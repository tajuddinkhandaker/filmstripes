@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container spark-screen filmstripes-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	{{ $user->name }}'s Profile
                </div>
                <div class="panel-body">
                    <img src="{{ route('users::avatar') }}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-left: 25px; margin-right: 25px;">
                	Hi <h1>{{ $user->name }}</h1>
                    <form enctype="multipart/form-data" action="{{ route('users::avatar') }}" method="POST">
                        {{ csrf_field() }}
                        <label>Update your profile</label>
                        <input type="file" name="avatar">
                        <input type="submit" class="pull-right btn btn-sm btn-primary" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
