<?php

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Faker\Factory as DemoFaker;
use Illuminate\Contracts\Logging\Log;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', [ 'uses' => 'HomeController@index', 'as' => 'dashboard' ]);

	Route::group(['as' => 'users::'], function () {

	    Route::get('/users/profile', [ 'uses' => 'UserController@profile', 'as' => 'profile' ]);
	    Route::get('/users/avatar', [ 'uses' => 'UserController@avatar', 'as' => 'avatar' ]);
	    Route::post('/users/avatar', [ 'uses' => 'UserController@changeAvatar', 'as' => 'avatar-change' ]);
	});

	Route::group(['as' => 'movies::'], function () {

	    Route::get('/movies', [ 'uses' => 'MovieController@index', 'as' => 'index' ]);
	    Route::get('/movies/register', [ 'uses' => 'MovieController@registerForm', 'as' => 'register-form' ]);
	    Route::post('/movies/register', [ 'uses' => 'MovieController@register', 'as' => 'register' ]);
	});
});

/*
|--------------------------------------------------------------------------
| filmstrips experimental routing
|--------------------------------------------------------------------------
|
|
*/
Route::get('/notepad', function () {
	$process = new Process('notepad.exe');
	$process->run();

	// executes after the command finishes
	if (!$process->isSuccessful()) {
	    throw new ProcessFailedException($process);
	}

    return $process->getOutput();
});


// "bestboysmedialab/language-list": "1.1.2"
Route::get('/languages', function()
{
    return Languages::getList('en', 'json');
});

Route::get('/faker/name', function() {

	$faker = DemoFaker::create();
	$search = 'John';
	session([ 'key' => $search ]); 
	$nameValidator = function($company) {
		return str_contains( strtolower((string) $company), strtolower(session('key')) );
	};
	$companies = array();
	try
	{
		for ($i=0; $i < 10; $i++)
			$companies []= $faker->valid($nameValidator)->company; //valid($nameValidator)->
	} catch (\OverflowException $e) {
	  return "Nothing to suggest! that contains " . session('key');
	}

	return $companies;

});