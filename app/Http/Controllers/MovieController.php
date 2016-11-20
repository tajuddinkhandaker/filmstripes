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
            return response()->json($request->all());
        }        
        $inputs = $request->only('genre');
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
            [ 'title' => 'English', 'value' => 'ENGLISH' ],
            [ 'title' => 'Hindi', 'value' => 'HINDI' ],
            [ 'title' => 'Bengali', 'value' => 'BENGALI' ],
            [ 'title' => 'Korean', 'value' => 'KOREAN' ],
        ];
        $boxsets = [
            [ 'title' => 'Iron Man', 'value' => 'IRONMAN' ],
            [ 'title' => 'Avengers', 'value' => 'AVENGERS' ],
            [ 'title' => 'Captain Ameraica', 'value' => 'CPT_AMERICA' ],
            [ 'title' => 'Batman', 'value' => 'BATMAN' ],
            [ 'title' => 'Spider Man 2', 'value' => 'SPIDERMAN2' ],
        ];
        $dvds = [
            [ 'title' => 'Horror 5', 'value' => 'HORROR_5' ],
            [ 'title' => 'Action + Adventure 3', 'value' => 'ACT_ADV_3' ],
            [ 'title' => 'ANIMATION 3', 'value' => 'ANIM_3' ],
        ];
        return view('movie-register')->withGenres(collect($genres))
                                     ->withLanguages(collect($languages))
                                     ->withBoxsets(collect($boxsets))
                                     ->withDvds(collect($dvds));
    }
}
