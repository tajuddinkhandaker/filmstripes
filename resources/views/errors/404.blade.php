@extends('layouts.app')

@section('content')

<div class="container spark-screen">
    <div class="row">

        <div class="col-xs-12 col-sm-7 col-lg-7">
            <!-- Info -->
            <div class="info">
                <h1>404</h1>
                <h2>page not found</h2>
                <p>The page you are looking for was moved, removed,
                    renamed or might never existed.</p>
                <a href="/home" class="btn btn-primary">Go Home</a>
                <a href="/" class="btn btn-success">Contact Us</a>
            </div>
            <!-- end Info -->
        </div>

        <div class="col-xs-12 col-sm-5 col-lg-5 text-center">
            <!-- Monkey -->
            <div class="monkey">
                <img src="/images/monkey.gif" alt="Monkey" width="350" height="450">
            </div>
            <!-- end Monkey -->
        </div>
    </div>
</div>
@endsection
