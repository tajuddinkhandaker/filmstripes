@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container spark-screen filmstripes-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <paper-icon-button class="pull-right" icon="search"></paper-icon-button>
                    <paper-input id="search-movie-title" placeholder="Search your movie title ..."></paper-input>
                </div>
                <div class="panel-body">
                    <div class="mdl-grid">
                      <div class="mdl-cell mdl-cell--4-col"><crystal-movie-poster></crystal-movie-poster></div>
                      <div class="mdl-cell mdl-cell--4-col"><crystal-movie-poster></crystal-movie-poster></div>
                      <div class="mdl-cell mdl-cell--4-col"><crystal-movie-poster></crystal-movie-poster></div>
                      <div class="mdl-cell mdl-cell--4-col"><crystal-movie-poster></crystal-movie-poster></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
