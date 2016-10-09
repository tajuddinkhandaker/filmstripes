<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as MovieRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return 'My added movie collection';
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function register(MovieRequest $request)
    {
    	if($request->ajax()){
            return "AJAX";
        }
        abort(404);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function registerForm()
    {
        return view('movie-register');
    }
}
