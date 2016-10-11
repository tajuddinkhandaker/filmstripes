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
        $inputs = $request->only('title', 'release_year', 'genre');
        //return $inputs;

        return response()->json($request->all());
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function registerForm()
    {
        $genres = [
            [ 'title' => 'Horror', 'value' => 'HORROR' ],
            [ 'title' => 'Romantic', 'value' => 'ROMANTIC' ],
            [ 'title' => 'Adventure', 'value' => 'ADVENTURE' ],
        ];
        $languages = [
            [ 'title' => 'English', 'value' => 'HORROR' ],
            [ 'title' => 'Hindi', 'value' => 'ROMANTIC' ],
            [ 'title' => 'Bengali', 'value' => 'ADVENTURE' ],
            [ 'title' => 'Korean', 'value' => 'KOREAN' ],
        ];
        return view('movie-register')->withGenres(collect($genres))->withLanguages(collect($languages));
    }
}
